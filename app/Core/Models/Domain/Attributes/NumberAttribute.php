<?php


namespace App\Core\Models\Domain\Attributes;


use App\Core\Enums\AttributeType;

class NumberAttribute extends Attribute {

    public function __construct() {
        $this->initialize(AttributeType::NUMBER);
    }

    protected function buildSettings() {
        $this->settings = [
            "valueMin" => null,
            "valueMax" => null,
            "required" => null
        ];
    }
}
