<?php

namespace App\Http\Controllers;

use App\Core\Enums\Modules\ContractModulePart;
use App\Core\Helpers\Response;
use App\Http\Requests\Contracts\ContractAddRequest;
use App\Http\Requests\Contracts\ContractRemoveCollectionRequest;
use App\Http\Requests\Contracts\ContractRenderRequest;
use App\Http\Requests\Contracts\ContractUpdateRequest;
use App\Core\Models\Domain\Contract;
use App\Core\Services\Domain\ContractService;
use App\Core\Services\Domain\ContractModuleService;
use Illuminate\Http\Request;

class ContractController extends Controller {

    /**
     * @var ContractService
     */
    private $contractService;

    /**
     * @var \App\Core\Services\Domain\ContractModuleService
     */
    private $contractModuleService;

    public function __construct(ContractService $contractService, ContractModuleService $contractModuleService) {
        $this->contractService = $contractService;
        $this->contractModuleService = $contractModuleService;
    }

    public function add(ContractAddRequest $request) {
        $contract = new Contract();
        $contract->fill($request->validated());

        $fullContract = $this->contractService->createContract($contract);

        Response::success($fullContract);
    }

    public function render(ContractRenderRequest $request, Contract $contract) {
        $returnData = $this->contractModuleService->runPart($contract, ContractModulePart::RENDER_CONTRACT, [
            "formElements" => $request->get("formElements"),
            "contract" => $contract,
        ]);

        if (isset($returnData)) {
            return $returnData;
        }

        Response::success();
    }

    public function remove(Request $request, int $contractID) {
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

    public function getCollection(Request $request) {
        Response::success(Contract::all());
    }

    public function get(Request $request, Contract $contract) {
        Response::success($contract);
    }

    public function update(ContractUpdateRequest $request, Contract $contract) {
        $contract->fill($request->validated());
        $fullContract = $this->contractService->createContract($contract);
        Response::success($fullContract);
    }
}
