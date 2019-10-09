<?php

namespace App\Http\Controllers;

use App\Enums\Modules\ContractModulePart;
use App\Helpers\Response;
use App\Helpers\Validator;
use App\Models\Domain\Contract;
use App\Models\Domain\FormElements\FormElement;
use App\Modules\Configuration;
use App\Repository\Domain\ContractRepository;
use App\Services\AuthService;
use App\Services\Domain\ContractService;
use App\Services\Domain\FormService;
use App\Services\Domain\ContractModuleService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ContractController extends Controller {

    /**
     * @var ContractService
     */
    private $contractService;

    /**
     * @var FormService
     */
    private $formService;

    /**
     * @var \App\Repository\Domain\ContractRepository
     */
    private $contractRepository;

    /**
     * @var \App\Services\Domain\ContractModuleService
     */
    private $contractModuleService;

    /**
     * @var \App\Services\AuthService
     */
    private $authService;

    /**
     * @var \App\Modules\Configuration
     */
    private $configuration;

    public function __construct(ContractService $contractService, FormService $formService,
                                ContractRepository $contractRepository, ContractModuleService $contractModuleService,
                                AuthService $authService, Configuration $configuration) {
        $this->contractService = $contractService;
        $this->formService = $formService;
        $this->contractRepository = $contractRepository;
        $this->contractModuleService = $contractModuleService;
        $this->authService = $authService;
        $this->configuration = $configuration;
    }

    public function addNewContract(Request $request) {
        Validator::validate($request->all(), Contract::$rulesAddRequestCreate);

        $contract = new Contract();
        $contract->fill($request->all());

        $fullContract = $this->contractService->addContract($contract);

        Response::success($fullContract);
    }

    public function getContractForm(Request $request, int $contractID) {
        Validator::validate($request->all(), [
            "password" => "nullable|string",
        ]);

        $contract = $this->contractRepository->getById($contractID);

        $this->contractModuleService->runPart($contract, ContractModulePart::GET_CONTRACT, [
            "password" => $request->get("password") ?? "",
        ]);

        Response::success($contract->form->formElements);
    }

    public function renderContractForm(Request $request, int $contractID) {
        Validator::validate($request->all(), [
            "formElements" => "required|array",
        ]);

        $contract = $this->contractRepository->getById($contractID);
        $returnData = $this->contractModuleService->runPart($contract, ContractModulePart::RENDER_CONTRACT, [
            "formElements" => $request->get("formElements"),
            "contract" => $contract,
        ]);

        if (isset($returnData)) {
            return $returnData;
        }

        Response::success();
    }

    public function removeContract(Request $request, int $contractID) {
        $this->contractService->removeContractById([$contractID]);
        Response::success();
    }

    public function removeMultiContract(Request $request) {
        Validator::validate($request->all(), [
            "idList" => "required|string",
        ]);

        $listOfContractId = explode(",", $request->get("idList"));

        if (is_array($listOfContractId)) {
            $this->contractService->removeContractById($listOfContractId);
        }

        Response::success();
    }

    public function getContractList(Request $request) {
        $contractCollection = $this->contractRepository->getContractCollection();
        Response::success($contractCollection);
    }

    public function getAvailableModules(Request $request) {
        $availableModules = $this->configuration->availableModules;
        Response::success($availableModules);
    }

    public function getInformationAboutContractModules(Request $request, int $contractID) {
        $contract = $this->contractRepository->getById($contractID);
        Response::success($this->contractModuleService->getModuleInformation($contract));
    }
}
