<?php


namespace App\Core\Models\Domain\Attributes;


use App\Core\Enums\AttributeType;

class DateAttribute extends Attribute {

    public function __construct() {
        $this->initialize(AttributeType::DATE);
    }

    protected function buildSettings() {
        $this->settings = [
            'valueMin' => null,
            'valueMax' => null,
            'required' => false,
        ];
    }
}
