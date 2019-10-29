<?php


namespace App\Core\Models\Domain\Attributes;


use App\Core\Enums\AttributeType;

class TextAttribute extends Attribute {

    public function __construct() {
        $this->initialize(AttributeType::TEXT);
    }

    protected function buildSettings() {
        $this->settings = [
            "lengthMin" => null,
            "lengthMax" => null,
            "required" => null
        ];
    }

    public function getValue(){
        return "'{$this->value}'";
    }
}
