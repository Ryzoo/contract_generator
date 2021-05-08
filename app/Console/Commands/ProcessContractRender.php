<?php

namespace App\Console\Commands;

use App\Core\Enums\ContractFormCompleteStatus;
use App\Core\Models\Database\ContractFormComplete;
use App\Core\Services\Contract\ContractModuleService;
use App\Jobs\RenderNewContract;
use App\Notifications\ContractRenderFinished;
use Carbon\Carbon;
use Illuminate\Console\Command;

class ProcessContractRender extends Command
{
  protected $signature = 'contract:render';
  protected $description = 'Process one of the contract from list';
  private ContractModuleService $contractModuleService;

  public function __construct(ContractModuleService $contractModuleService)
  {
    parent::__construct();
    $this->contractModuleService = $contractModuleService;
  }

  public function handle(): int
  {
    $this->checkNotRenderedAndPending();

    $lastNewContracts = ContractFormComplete::with('contract')
      ->where('status', 'LIKE', ContractFormCompleteStatus::NEW)
      ->oldest()
      ->take(3)
      ->get();

    foreach ($lastNewContracts as $contract) {
      $contract->update([
        'status' => ContractFormCompleteStatus::PENDING
      ]);

      RenderNewContract::dispatchNow($contract, $this->contractModuleService);
    }

    return 0;
  }

  private function checkNotRenderedAndPending(): void {
    $contractToCancel = ContractFormComplete::with('contract')
      ->where('status', 'LIKE', ContractFormCompleteStatus::PENDING)
      ->where('updated_at', '<', Carbon::now()->subMinutes(1))
      ->get();

    if ($contractToCancel->count() > 0) {
      foreach ($contractToCancel as $contract) {
        $contract->update([
          'status' => ContractFormCompleteStatus::ERROR
        ]);
        $contract->user->notify(new ContractRenderFinished(ContractFormCompleteStatus::ERROR));
      }
    }
  }
}
