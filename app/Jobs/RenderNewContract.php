<?php

namespace App\Jobs;

use App\Core\Enums\ContractFormCompleteStatus;
use App\Core\Enums\Modules\ContractModulePart;
use App\Core\Models\Database\ContractFormComplete;
use App\Core\Services\Contract\ContractModuleService;
use App\Notifications\ContractRenderFinished;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class RenderNewContract implements ShouldQueue {

  use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

  public $tries = 3;
  public $retryAfter = 1;
  private ContractFormComplete $contractFormComplete;
  private ContractModuleService $contractModuleService;

  public function __construct(ContractFormComplete $contractFormComplete, ContractModuleService $contractModuleService) {
    $this->contractFormComplete = $contractFormComplete;
    $this->contractModuleService = $contractModuleService;
  }

  public function handle(): void {
    $this->contractModuleService->runPart($this->contractFormComplete->contract,
      ContractModulePart::RENDER_CONTRACT, [
        'formComplete' => $this->contractFormComplete,
      ]);
  }

  public function fail($exception = NULL) {
    $this->contractFormComplete->contract->update([
      'status' => ContractFormCompleteStatus::ERROR,
    ]);
    $this->contractFormComplete->contract->user->notify(new ContractRenderFinished(ContractFormCompleteStatus::ERROR));

  }
}
