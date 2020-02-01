<?php

namespace App\Console\Commands;

use App\Core\Enums\ContractFormCompleteStatus;
use App\Core\Models\Database\ContractFormComplete;
use App\Core\Services\Contract\ContractModuleService;
use App\Jobs\RenderNewContract;
use Carbon\Carbon;
use Illuminate\Console\Command;

class ProcessContractRender extends Command
{
  /**
   * @var string
   */
  protected $signature = 'contract:render';

  /**
   * @var string
   */
  protected $description = 'Process one of the contract from list';
  /**
   * @var ContractModuleService
   */
  private $contractModuleService;

  public function __construct(ContractModuleService $contractModuleService)
  {
    parent::__construct();
    $this->contractModuleService = $contractModuleService;
  }

  public function handle()
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

      RenderNewContract::dispatch($contract, $this->contractModuleService)
        ->delay(Carbon::now()->addSeconds(5));
    }
  }

  private function checkNotRenderedAndPending()
  {
    $contractToCancel = ContractFormComplete::with('contract')
      ->where('status', 'LIKE', ContractFormCompleteStatus::PENDING)
      ->where('updated_at', '<', Carbon::now()->subMinutes(2))
      ->get();

    if ($contractToCancel->count() > 0)
      foreach ($contractToCancel as $contract) {
        $contract->update([
          'status' => ContractFormCompleteStatus::ERROR
        ]);
      }
  }
}
