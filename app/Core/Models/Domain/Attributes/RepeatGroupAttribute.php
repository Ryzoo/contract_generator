<?php


namespace App\Core\Models\Domain\Attributes;


use App\Core\Enums\AttributeType;

class RepeatGroupAttribute extends Attribute {

    public function __construct() {
        $this->initialize(AttributeType::REPEAT_GROUP);
    }

    protected function buildSettings() {
        $this->settings = [
            "valueMin" => null,
            "valueMax" => null,
            "required" => null
        ];
    }

    public function getValue(){
        return intval($this->value);
    }
}
