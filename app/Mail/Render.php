<?php

namespace App\Mail;

use App\Core\Models\Domain\ContractFormComplete;
use App\Core\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Render extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * @var ContractFormComplete
     */
    public $formComplete;

    public function __construct(ContractFormComplete $formComplete) {
        $this->formComplete = $formComplete;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject(__("email.render.subject"))
            ->markdown('emails.render')
            ->attachFromStorage($this->formComplete->render_url);
    }
}
