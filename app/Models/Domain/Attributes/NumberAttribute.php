<?php


namespace App\Models\Domain\Attributes;


use App\Enums\AttributeType;

class NumberAttribute extends Attribute {

    public function __construct() {
        $this->initialize(AttributeType::NUMBER);
    }

    protected function buildSettings() {
        $this->settings = [
            "min" => null,
            "max" => null
        ];
    }

    public function getValue(){
        return intval($this->value);
    }
}
