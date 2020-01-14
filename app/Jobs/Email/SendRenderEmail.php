<?php

namespace App\Jobs\Email;

use App\Core\Enums\ContractFormCompleteStatus;
use App\Core\Models\Domain\ContractFormComplete;
use App\Mail\Render;
use App\Core\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Mail;

class SendRenderEmail implements ShouldQueue {

    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * The number of times the job may be attempted.
     *
     * @var int
     */
    public $tries = 5;

    /**
     * @var ContractFormComplete
     */
    private $formComplete;

    public function __construct(ContractFormComplete $formComplete) {
        $this->formComplete = $formComplete;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle() {
        $this->formComplete->status = ContractFormCompleteStatus::DELIVERED;
        $this->formComplete->save();

        Mail::to($this->formComplete->user->email)
          ->send(new Render($this->formComplete));
    }
}
