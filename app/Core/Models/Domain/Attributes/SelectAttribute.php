<?php


namespace App\Core\Models\Domain\Attributes;


use App\Core\Enums\AttributeType;

class SelectAttribute extends Attribute {

    public function __construct() {
        $this->initialize(AttributeType::SELECT);
    }

    protected function buildSettings() {
        $this->settings = [
            'isMultiSelect' => false,
            'items' => [],
            'required' => null,
            'lengthMin' => null,
            'lengthMax' => null,
        ];
    }
}
