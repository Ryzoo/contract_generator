<?php


namespace App\Core\Models\Domain\Attributes;


use App\Core\Enums\AttributeType;

class BoolAttribute extends Attribute {

    public function __construct() {
        $this->initialize(AttributeType::BOOL);
    }

    protected function buildSettings() {
        $this->settings = [
            'required' => false,
        ];
    }

    public function getValue() {
      return !isset($this->value) ? '0' : (string) $this->value;
    }
}
