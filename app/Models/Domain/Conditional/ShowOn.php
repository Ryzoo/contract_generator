<?php


namespace App\Models\Domain\Conditional;

use App\Enums\ConditionalType;

class ShowOn extends Conditional {

    public function __construct() {
        $this->initialize(ConditionalType::SHOW_ON);
    }

}
