<?php

namespace App\Http\Controllers\Contract;

use App\Core\Helpers\Response;
use App\Core\Models\Database\Contract;
use App\Core\Modules\Configuration;
use App\Core\Services\Contract\ContractModuleService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ContractModulesController extends Controller {
  private ContractModuleService $contractModuleService;
  private Configuration $configuration;

  public function __construct(ContractModuleService $contractModuleService,
                              Configuration $configuration) {
    $this->contractModuleService = $contractModuleService;
    $this->configuration = $configuration;
  }

  public function getAvailable(Request $request) {
    $availableModules = $this->configuration->getAvailableModules();
    Response::success($availableModules);
  }

  public function getInformationFromContract(Request $request, Contract $contract) {
    Response::success($this->contractModuleService->getModuleInformation($contract));
  }
}
