<?php


namespace App\Core\Models\Domain\Attributes;


use App\Core\Enums\AttributeType;

class TimeAttribute extends Attribute {

    public function __construct() {
        $this->initialize(AttributeType::TIME);
    }

    protected function buildSettings() {
        $this->settings = [
            'valueMin' => null,
            'valueMax' => null,
            'required' => false,
        ];
    }
}
