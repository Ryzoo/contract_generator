<?php

namespace App\Jobs;

use App\Core\Enums\ContractFormCompleteStatus;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Collection;

class CancelContractProcess implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
  /**
   * @var Collection
   */
  private $contractCompleteCollection;

    public function __construct(Collection $contractCompleteCollection)
    {
      $this->contractCompleteCollection = $contractCompleteCollection;
    }

    public function handle()
    {
        foreach ($this->contractCompleteCollection as $contract){
          $contract->update([
            'status' => ContractFormCompleteStatus::ERROR
          ]);
        }
    }
}
