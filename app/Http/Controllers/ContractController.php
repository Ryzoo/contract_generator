<?php

namespace App\Http\Controllers;

use App\Helpers\Response;
use App\Helpers\Validator;
use App\Models\Domain\Attributes\Attribute;
use App\Models\Domain\Contract;
use App\Repository\Domain\ContractRepository;
use App\Services\Domain\ContractService;
use App\Services\Domain\FormService;
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

    public function __construct(ContractService $contractService, FormService $formService, ContractRepository $contractRepository) {
        $this->contractService = $contractService;
        $this->formService = $formService;
        $this->contractRepository = $contractRepository;
    }

    public function addNewContract(Request $request) {
        Validator::validate($request->all(), Contract::$rulesAddRequestCreate);

        $contract = new Contract();
        $contract->fill($request->all());

        $fullContract = $this->contractService->addContract($contract);

        Response::success($fullContract);
    }

    public function getContractForm(Request $request, int $contractID) {
        $contract = $this->contractRepository->getById($contractID);
        $formInputs = $contract->form->formInputs;
        Response::success($formInputs);
    }

    public function renderContractForm(Request $request, int $contractID) {
        Validator::validate($request->all(),[
            "attributesList" => "required|array"
        ]);

        $attributeString = json_encode($request->get("attributesList"));
        $attributeList = Attribute::getListFromString($attributeString);

        $contractPdfFile = $this->contractService->renderContract($contractID, $attributeList);

        return $contractPdfFile->stream(Str::random(8).".pdf");
    }

    public function removeContract(Request $request, int $contractID) {
        $this->contractService->removeContractById($contractID);
        Response::success();
    }

    public function getContractList(Request $request){
        $contractCollection = $this->contractRepository->getContractCollection();
        Response::success($contractCollection);
    }
}
