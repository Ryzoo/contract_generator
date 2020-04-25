<?php

namespace App\Jobs\Email;

use App\Mail\Welcome;
use App\Core\Models\Database\User;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Mail;

class SendWelcomeEmail implements ShouldQueue {
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public int $tries = 5;
    protected $userModel;

    public function __construct($userModel) {
        $this->userModel = $userModel;
    }

    public function handle(): void {
        Mail::to($this->userModel->email)
            ->send(new Welcome($this->userModel));
    }
}
