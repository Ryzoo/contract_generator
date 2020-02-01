<?php


namespace App\Core\Models\Domain\Conditional;

use App\Core\Enums\ConditionalType;

class ShowOn extends Conditional {

    public function __construct() {
        $this->initialize(ConditionalType::SHOW_ON);
    }

}
