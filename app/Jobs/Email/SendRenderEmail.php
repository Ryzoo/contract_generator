<?php

namespace App\Jobs\Email;

use App\Core\Enums\ContractFormCompleteStatus;
use App\Core\Models\Database\ContractFormComplete;
use App\Mail\Render;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Mail;

class SendRenderEmail implements ShouldQueue {

  use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

  public int $tries = 5;
  private ContractFormComplete $formComplete;

  public function __construct(ContractFormComplete $formComplete) {
    $this->formComplete = $formComplete;
  }

  public function handle(): void {
    Mail::to($this->formComplete->user->email)
      ->send(new Render($this->formComplete));

    $this->formComplete->update([
      'status' => ContractFormCompleteStatus::DELIVERED,
    ]);
  }
}
