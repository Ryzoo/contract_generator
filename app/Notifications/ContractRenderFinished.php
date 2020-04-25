<?php

namespace App\Notifications;

use App\Core\Enums\ContractFormCompleteStatus;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class ContractRenderFinished extends Notification {

  private string $status;

  public function __construct(string $status) {
    $this->status = $status;
  }

  public function via($notifiable): array {
    return ['mail', 'database'];
  }

  public function toMail($notifiable): MailMessage {
    $mail = (new MailMessage)
      ->line(__('notifications.renderFinish.title'));

    if ($this->status === ContractFormCompleteStatus::ERROR) {
      $mail = $mail
        ->line(__('notifications.renderFinish.status.4'));
    }
    else {
      $mail = $mail
        ->line(__('notifications.renderFinish.status.2'));
    }

    return $mail;
  }

  public function toArray($notifiable):array {
    $message = __('notifications.renderFinish.title');

    if ($this->status === ContractFormCompleteStatus::ERROR) {
      $message .= ' ' . __('notifications.renderFinish.status.4');
    }
    else {
      $message .= ' ' . __('notifications.renderFinish.status.2');
    }

    return [
      'message' => $message,
    ];
  }
}
