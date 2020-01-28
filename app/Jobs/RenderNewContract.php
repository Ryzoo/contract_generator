<?php

namespace App\Jobs;

use App\Core\Enums\Modules\ContractModulePart;
use App\Core\Models\Database\ContractFormComplete;
use App\Core\Services\Contract\ContractModuleService;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class RenderNewContract implements ShouldQueue
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

  public function __construct(ContractFormComplete $contractFormComplete, ContractModuleService $contractModuleService)
    {
      $this->contractFormComplete = $contractFormComplete;
      $this->contractModuleService = $contractModuleService;
    }

  /**
   * Execute the job.
   *
   * @return void
   */
    public function handle(): void
    {
        $this->contractModuleService->runPart($this->contractFormComplete->contract,
          ContractModulePart::RENDER_CONTRACT, [
          'formComplete' => $this->contractFormComplete
        ]);
    }
}
