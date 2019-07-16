<?php


namespace App\Models\Domain\Attributes;


use App\Enums\AttributeType;

class NumberAttribute extends Attribute {

    public function __construct() {
        $this->initialize(AttributeType::NUMBER);
    }

    protected function buildSettings() {
        // TODO: Implement buildSettings() method.
    }
}