<?php


namespace App\Models\Domain\Attributes;


use App\Enums\AttributeType;

class TextAttribute extends Attribute {

    public function __construct() {
        $this->initialize(AttributeType::TEXT);
    }

    protected function buildSettings() {
        $this->settings = [
            "lengthMin" => null,
            "lengthMax" => null
        ];
    }

    public function getValue(){
        return $this->value;
    }
}
