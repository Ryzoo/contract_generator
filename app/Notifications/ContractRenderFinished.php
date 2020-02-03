<?php

namespace App\Notifications;

use App\Core\Enums\ContractFormCompleteStatus;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class ContractRenderFinished extends Notification{
  /**
   * @var string
   */
  private $status;

  /**
   * Create a new notification instance.
   *
   * @param string $status
   */
  public function __construct(string $status) {
    $this->status = $status;
  }

  /**
   * Get the notification's delivery channels.
   *
   * @param mixed $notifiable
   *
   * @return array
   */
  public function via($notifiable) {
    return ['mail', 'database'];
  }

  /**
   * Get the mail representation of the notification.
   *
   * @param mixed $notifiable
   *
   * @return \Illuminate\Notifications\Messages\MailMessage
   */
  public function toMail($notifiable) {
    $mail = (new MailMessage)
      ->line(__('notifications.renderFinish.title'));

    if($this->status === ContractFormCompleteStatus::ERROR)
      $mail = $mail
        ->line(__('notifications.renderFinish.status.4'));
    else
      $mail = $mail
        ->line(__('notifications.renderFinish.status.2'));

    return $mail;
  }

  /**
   * Get the array representation of the notification.
   *
   * @param mixed $notifiable
   *
   * @return array
   */
  public function toArray($notifiable) {

    $message = __('notifications.renderFinish.title');

    if($this->status === ContractFormCompleteStatus::ERROR)
      $message .= ' ' . __('notifications.renderFinish.status.4');
    else
      $message .= ' ' . __('notifications.renderFinish.status.2');

    return [
      'message' => $message
    ];
  }
}
