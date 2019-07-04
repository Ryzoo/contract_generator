<?php

namespace App\Jobs\Email;

use App\Mail\Welcome;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailer;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Mail;

class SendWelcomeEmail implements ShouldQueue {

    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * The number of times the job may be attempted.
     *
     * @var int
     */
    public $tries = 5;

    /**
     * @var User
     */
    protected $userModel;

    /**
     * Create a new job instance.
     *
     * @param \App\Models\User $userModel
     */
    public function __construct(User $userModel) {
        $this->userModel = $userModel;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle() {
        Mail::to($this->userModel->email)
            ->send(new Welcome($this->userModel));
    }
}
