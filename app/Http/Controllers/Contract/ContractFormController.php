<?php

namespace App\Http\Controllers\Contract;

use App\Core\Enums\Modules\ContractModulePart;
use App\Core\Helpers\Response;
use App\Core\Models\Domain\Contract;
use App\Core\Services\Domain\ContractModuleService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Contracts\ContractFormGetRequest;

class ContractFormController extends Controller {

    /**
     * @var \App\Core\Services\Domain\ContractModuleService
     */
    private $contractModuleService;

    public function __construct(ContractModuleService $contractModuleService) {
        $this->contractModuleService = $contractModuleService;
    }

    public function get(ContractFormGetRequest $request, Contract $contract) {

        $this->contractModuleService->runPart($contract, ContractModulePart::GET_CONTRACT, [
            "password" => $request->get("password") ?? "",
        ]);

        Response::success($contract->form->formElements);
    }
}
