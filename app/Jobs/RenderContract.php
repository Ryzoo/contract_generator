<?php

namespace App\Jobs;

use App\Core\Enums\Modules\ContractModulePart;
use App\Core\Models\Domain\ContractFormComplete;
use App\Core\Services\Domain\ContractModuleService;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class RenderContract implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
  /**
   * @var ContractFormComplete
   */
  private $contractFormComplete;

  public function __construct(ContractFormComplete $contractFormComplete)
    {
      $this->contractFormComplete = $contractFormComplete;
    }

  /**
   * Execute the job.
   *
   * @param ContractModuleService $contractModuleService
   * @return void
   */
    public function handle(ContractModuleService $contractModuleService): void
    {
        $contractModuleService->runPart($this->contractFormComplete->contract,
          ContractModulePart::RENDER_CONTRACT, [
          'formComplete' => $this->contractFormComplete
        ]);
    }
}
