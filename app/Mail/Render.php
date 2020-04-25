<?php

namespace App\Mail;

use App\Core\Helpers\Url;
use App\Core\Models\Database\ContractFormComplete;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Render extends Mailable
{
    use Queueable, SerializesModels;

    public ContractFormComplete $formComplete;

    public function __construct(ContractFormComplete $formComplete) {
        $this->formComplete = $formComplete;
    }

    public function build(): Mailable {
        return $this->subject(__('email.render.subject'))
            ->markdown('emails.render')
            ->attachFromStorage(Url::RemoveStorage($this->formComplete->render_url));
    }
}
