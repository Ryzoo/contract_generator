<?php

namespace App\Mail;

use App\Core\Models\Database\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Welcome extends Mailable {

  use Queueable, SerializesModels;

  public User $user;

  public function __construct(User $user) {
    $this->user = $user;
  }

  public function build(): Mailable {
    return $this->subject(__('email.welcome.subject'))
      ->markdown('emails.welcome');
  }
}
