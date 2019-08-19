<?php

namespace App\Http\Controllers;

use App\Helpers\Response;
use App\Helpers\Validator;
use App\Models\Domain\Contract;
use App\Services\Domain\ContractService;
use Illuminate\Http\Request;

class ContractController extends Controller
{
    /**
     * @var ContractService
     */
    private $contractService;

    public function __construct(ContractService $contractService) {
        $this->contractService = $contractService;
    }

    public function addNewContract(Request $request) {
        Validator::validate($request->all(), Contract::$rulesAddRequestCreate);

        $contract = new Contract();
        $contract->fill($request->all());

        $fullContract = $this->contractService->addContract($contract);

        Response::success($fullContract);
    }
}
