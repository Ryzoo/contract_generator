<?php

namespace App\Jobs;

use App\Core\Models\Database\Contract;
use App\Core\Services\Contract\ContractService;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class UpdateContract implements ShouldQueue {

  use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

  public $tries = 3;
  public $retryAfter = 1;
  private Contract $contract;
  private ContractService $contractModuleService;

  public function __construct(Contract $contract, ContractService $contractModuleService) {
    $this->contract = $contract;
    $this->contractModuleService = $contractModuleService;
  }

  public function handle(): void {
    $this->contractModuleService->createContract($this->contract);
  }
}
