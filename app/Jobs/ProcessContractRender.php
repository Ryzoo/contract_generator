<?php

namespace App\Jobs;

use App\Core\Enums\ContractFormCompleteStatus;
use App\Core\Enums\Modules\ContractModulePart;
use App\Core\Models\Domain\ContractFormComplete;
use App\Core\Services\Domain\ContractModuleService;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class ProcessContractRender implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
  /**
   * @var ContractFormComplete
   */
  private $contractFormComplete;
  /**
   * @var ContractModuleService
   */
  private $contractModuleService;


  public function __construct(ContractModuleService $contractModuleService, ContractFormComplete $contractFormComplete)
    {
      $this->contractFormComplete = $contractFormComplete;
      $this->contractModuleService = $contractModuleService;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->contractFormComplete ->update([
          'status' => ContractFormCompleteStatus::PENDING
        ]);

        $this->contractModuleService->runPart($this->contractFormComplete ->contract, ContractModulePart::RENDER_CONTRACT, [
          'formComplete' => $this->contractFormComplete
        ]);
    }
}
