<?php

namespace App\Http\Controllers;

use App\Helpers\Response;
use App\Helpers\Validator;
use App\Models\Domain\Contract;
use App\Services\Domain\ContractService;
use App\Services\Domain\FormService;
use Illuminate\Http\Request;

class ContractController extends Controller {

    /**
     * @var ContractService
     */
    private $contractService;

    /**
     * @var FormService
     */
    private $formService;

    public function __construct(ContractService $contractService, FormService $formService) {
        $this->contractService = $contractService;
        $this->formService = $formService;
    }

    public function addNewContract(Request $request) {
        Validator::validate($request->all(), Contract::$rulesAddRequestCreate);

        $contract = new Contract();
        $contract->fill($request->all());

        $fullContract = $this->contractService->addContract($contract);

        Response::success($fullContract);
    }

    public function getContractForm(Request $request, int $contractID) {
        $contract = Contract::getById($contractID);

        $formToRender = $this->formService->getContractFormForRender($contract);

        Response::success($formToRender);
    }

    public function getContractList(Request $request){
        $contractCollection = $this->contractService->getContractCollection();
        Response::success($contractCollection);
    }
}
