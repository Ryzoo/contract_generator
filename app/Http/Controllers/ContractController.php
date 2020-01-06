<?php

namespace App\Http\Controllers;

use App\Core\Enums\Modules\ContractModulePart;
use App\Core\Helpers\Response;
use App\Core\Models\Domain\ContractFormComplete;
use App\Core\Models\Domain\FormElements\FormElement;
use App\Core\Models\User;
use App\Http\Requests\Contracts\ContractAddRequest;
use App\Http\Requests\Contracts\ContractGetRequest;
use App\Http\Requests\Contracts\ContractRemoveCollectionRequest;
use App\Http\Requests\Contracts\ContractRemoveRequest;
use App\Http\Requests\Contracts\ContractRenderRequest;
use App\Http\Requests\Contracts\ContractSubmissionGetRequest;
use App\Http\Requests\Contracts\ContractUpdateRequest;
use App\Core\Models\Domain\Contract;
use App\Core\Services\Domain\ContractService;
use App\Core\Services\Domain\ContractModuleService;
use App\Http\Resources\ContractInfo;
use App\Http\Resources\ContractInfoCollection;
use App\Http\Resources\ContractSubmissionCollection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContractController extends Controller {

    /**
     * @var ContractService
     */
    private $contractService;

    /**
     * @var ContractModuleService
     */
    private $contractModuleService;

    public function __construct(ContractService $contractService, ContractModuleService $contractModuleService) {
        $this->contractService = $contractService;
        $this->contractModuleService = $contractModuleService;
    }

    public function getCollection(Request $request) {
        Response::success(new ContractInfoCollection(Contract::with('categories')->get()));
    }

    public function get(ContractGetRequest $request, int $contractId) {
        $contract = Contract::with('categories')->findOrFail($contractId);
        Response::success($contract);
    }

    public function add(ContractAddRequest $request) {
        $contractData = $request->validated();
        $contractCategories = $request->validated()['categories'];

        $contract = new Contract();
        $contract->fill(collect($contractData)->except('categories')->toArray());

        $fullContract = $this->contractService->createContract($contract);
        $fullContract->categories()->attach($contractCategories);

        Response::success($fullContract);
    }

    public function update(ContractUpdateRequest $request, Contract $contract) {
        $contractData = $request->validated();
        $contractCategories = $request->validated()['categories'];

        $contract->fill(collect($contractData)->except('categories')->toArray());
        $fullContract = $this->contractService->createContract($contract);
        $fullContract->categories()->sync($contractCategories);

        Response::success($fullContract);
    }

    public function remove(ContractRemoveRequest $request, int $contractID) {
        $this->contractService->removeContractById([$contractID]);
        Response::success();
    }

    public function removeCollection(ContractRemoveCollectionRequest $request) {
        $listOfContractId = explode(",", $request->get("idList"));

        if (is_array($listOfContractId)) {
            $this->contractService->removeContractById($listOfContractId);
        }

        Response::success();
    }

    public function render(ContractRenderRequest $request, Contract $contract) {
        $formElements = FormElement::getListFromString(json_encode($request->get('formElements')));

        if(Auth::hasUser()){
            ContractFormComplete::create([
                'user_id' => Auth::user()->id,
                'contract_id' => $contract->id,
                'form_elements' => $formElements,
            ]);
        }

        Response::success();
    }

    public function submissions(ContractSubmissionGetRequest $render)
    {
        Response::json(
            new ContractSubmissionCollection(
                ContractFormComplete::with('contract')
                    ->where('user_id', Auth::user()->id)
                    ->get()
            )
        );
    }
}
