<?php

namespace App\Http\Controllers;

use App\Core\Enums\ContractAdditionalActionType;
use App\Core\Enums\ContractFormCompleteStatus;
use App\Core\Enums\Modules\ContractModulePart;
use App\Core\Helpers\Response;
use App\Core\Models\Database\ContractFormComplete;
use App\Core\Models\Domain\ContractSettings;
use App\Core\Models\Domain\FormElements\FormElement;
use App\Core\Providers\Przelewy24Provider;
use App\Http\Requests\Contracts\ContractAddRequest;
use App\Http\Requests\Contracts\ContractGetRequest;
use App\Http\Requests\Contracts\ContractRemoveCollectionRequest;
use App\Http\Requests\Contracts\ContractRemoveRequest;
use App\Http\Requests\Contracts\ContractRenderRequest;
use App\Http\Requests\Contracts\ContractSubmissionGetRequest;
use App\Http\Requests\Contracts\ContractUpdateRequest;
use App\Core\Models\Database\Contract;
use App\Core\Services\Contract\ContractService;
use App\Core\Services\Contract\ContractModuleService;
use App\Http\Resources\ContractInfoCollection;
use App\Http\Resources\ContractSubmissionCollection;
use App\Jobs\RenderNewContract;
use App\Jobs\UpdateContract;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;

class ContractController extends Controller
{

    private ContractService $contractService;
    private ContractModuleService $contractModuleService;


    public function __construct(ContractService $contractService, ContractModuleService $contractModuleService)
    {
        $this->contractService = $contractService;
        $this->contractModuleService = $contractModuleService;
    }

    public function makeOnline(Contract $contract)
    {
        $contract->update([
            'isAvailable' => true,
        ]);

        return Response::success();
    }

    public function makeOffline(Contract $contract)
    {
        $contract->update([
            'isAvailable' => false,
        ]);

        return Response::success();
    }

    public function getCollection(Request $request)
    {
        Response::success(new ContractInfoCollection(Contract::with('categories')
            ->latest()
            ->get()));
    }

    public function get(ContractGetRequest $request, int $contractId)
    {
        $contract = Contract::with('categories')->findOrFail($contractId);
        Response::success($contract);
    }

    public function payment(Request $request, ContractFormComplete $contractFormComplete)
    {
        $orderId = $request->get('orderId');
        $id = $contractFormComplete->id;
        $verify = json_decode($contractFormComplete->action_details, true)['verify_data'];
        $amount = $verify['amount'];
        $currency = $verify['currency'];
        $country = $verify['country'];

        $payment = new Przelewy24Provider($id, null, $amount, $currency, '', $country, Lang::getLocale());

        if($payment->verify($orderId)){
            $contractFormComplete->update([
                'status' => ContractFormCompleteStatus::NEW,
                'action_details' => json_encode([
                    'action_type' => ContractAdditionalActionType::PAYMENT,
                    'payment_is_pending' => false,
                ], JSON_THROW_ON_ERROR),
            ]);

            Response::success();
        }

        Response::error('Problem with verify');
    }

    public function add(ContractAddRequest $request)
    {
        $contractData = $request->validated();
        $contractCategories = $request->validated()['categories'];
        $contractSettings = $request->validated()['settings'];

        $contract = new Contract();
        $contract->fill(collect($contractData)->except(['categories', 'settings'])->toArray());
        $contract->settings = ContractSettings::fromArray($contractSettings);

        $fullContract = $this->contractService->createContract($contract);
        $fullContract->categories()->attach($contractCategories);

        Response::success($fullContract);
    }

    public function update(ContractUpdateRequest $request, Contract $contract)
    {
        $contractData = $request->validated();
        $contractCategories = $request->validated()['categories'];
        $contractSettings = $request->validated()['settings'];

        $contract->fill(collect($contractData)->except(['categories', 'settings'])->toArray());
        $contract->settings = ContractSettings::fromArray($contractSettings);
        $contract->categories()->sync($contractCategories);
        $contract->save();

        UpdateContract::dispatch($contract, $this->contractService);

        Response::success();
    }

    public function remove(ContractRemoveRequest $request, int $contractID)
    {
        $this->contractService->removeContractById([$contractID]);
        Response::success();
    }

    public function removeCollection(ContractRemoveCollectionRequest $request)
    {
        $listOfContractId = explode(',', $request->get('idList'));

        if (is_array($listOfContractId)) {
            $this->contractService->removeContractById($listOfContractId);
        }

        Response::success();
    }

    public function render(ContractRenderRequest $request, Contract $contract)
    {
        $formElements = FormElement::getListFromString(json_encode($request->get('formElements'), JSON_THROW_ON_ERROR, 512));

        if (Auth::hasUser()) {
            $contractFormComplete = ContractFormComplete::create([
                'user_id' => Auth::user()->id,
                'contract_id' => $contract->id,
                'form_elements' => $formElements,
            ]);

            $this->contractModuleService->runPart($contract, ContractModulePart::AFTER_END_CONTRACT, [
                'formComplete' => $contractFormComplete,
            ]);
        }

        Response::success();
    }

    public function forceRender(ContractFormComplete $contractFormComplete)
    {
        RenderNewContract::dispatchNow($contractFormComplete, $this->contractModuleService);
    }

    public function retry(Request $request, ContractFormComplete $contract)
    {
        if ($contract->status !== ContractFormCompleteStatus::ERROR) {
            Response::error(__('response.badContractCompleteStatusRetry'));
        }

        $contract->update([
            'status' => ContractFormCompleteStatus::NEW,
        ]);

        Response::success();
    }

    public function submissions(ContractSubmissionGetRequest $render)
    {
        Response::json(
            new ContractSubmissionCollection(
                ContractFormComplete::with('contract')
                    ->where('user_id', Auth::user()->id)
                    ->latest()
                    ->get()
            )
        );
    }
}
