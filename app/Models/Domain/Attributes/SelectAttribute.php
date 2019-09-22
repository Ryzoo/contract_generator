<?php


namespace App\Models\Domain\Attributes;


use App\Enums\AttributeType;

class SelectAttribute extends Attribute {

    public function __construct() {
        $this->initialize(AttributeType::SELECT);
    }

    protected function buildSettings() {
        $this->settings = [
            "isMultiSelect" => false,
            "items" => []
        ];
    }

    public function getValue(){
        return "'{$this->value}'";
    }
}
