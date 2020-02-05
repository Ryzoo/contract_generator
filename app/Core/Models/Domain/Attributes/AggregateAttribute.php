<?php


namespace App\Core\Models\Domain\Attributes;


use App\Core\Enums\AttributeType;

class AggregateAttribute extends Attribute {

    public function __construct() {
        $this->initialize(AttributeType::AGGREGATE);
    }

    protected function buildSettings() {
        // type double or int
        $this->settings = [
          'type' => 'double',
          'precision' => 2,
        ];
    }

    public function getValue() {
      return $this->settings['type'] === 'float' ? round((double) $this->value, (int) $this->settings['precision']) : (int) $this->value;
    }
}
