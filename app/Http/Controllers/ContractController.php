<?php

namespace App\Http\Controllers;

use App\Core\Enums\ContractFormCompleteStatus;
use App\Core\Helpers\Response;
use App\Core\Models\Database\ContractFormComplete;
use App\Core\Models\Domain\ContractSettings;
use App\Core\Models\Domain\FormElements\FormElement;
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
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContractController extends Controller {

  private $contractService;

  public function __construct(ContractService $contractService) {
    $this->contractService = $contractService;
  }

  public function getCollection(Request $request) {
    Response::success(new ContractInfoCollection(Contract::with('categories')
      ->latest()
      ->get()));
  }

  public function get(ContractGetRequest $request, int $contractId) {
    $contract = Contract::with('categories')->findOrFail($contractId);
    Response::success($contract);
  }

  public function add(ContractAddRequest $request) {
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

  public function update(ContractUpdateRequest $request, Contract $contract) {
    $contractData = $request->validated();
    $contractCategories = $request->validated()['categories'];
    $contractSettings = $request->validated()['settings'];

    $contract->fill(collect($contractData)->except(['categories', 'settings'])->toArray());
    $contract->settings = ContractSettings::fromArray($contractSettings);

    $fullContract = $this->contractService->createContract($contract);
    $fullContract->categories()->sync($contractCategories);

    Response::success($fullContract);
  }

  public function remove(ContractRemoveRequest $request, int $contractID) {
    $this->contractService->removeContractById([$contractID]);
    Response::success();
  }

  public function removeCollection(ContractRemoveCollectionRequest $request) {
    $listOfContractId = explode(',', $request->get('idList'));

    if (is_array($listOfContractId)) {
      $this->contractService->removeContractById($listOfContractId);
    }

    Response::success();
  }

  public function render(ContractRenderRequest $request, Contract $contract) {
    $formElements = FormElement::getListFromString(json_encode($request->get('formElements'), JSON_THROW_ON_ERROR, 512));

    if (Auth::hasUser()) {
      ContractFormComplete::create([
        'user_id' => Auth::user()->id,
        'contract_id' => $contract->id,
        'form_elements' => $formElements,
      ]);
    }

    Response::success();
  }

  public function retry(Request $request, ContractFormComplete $contract) {
    if ($contract->status !== ContractFormCompleteStatus::ERROR) {
      Response::error(__('response.badContractCompleteStatusRetry'));
    }

    $contract->update([
      'status' => ContractFormCompleteStatus::NEW,
    ]);

    Response::success();
  }

  public function submissions(ContractSubmissionGetRequest $render) {
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
