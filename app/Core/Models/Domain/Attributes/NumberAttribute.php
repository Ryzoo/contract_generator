<?php


namespace App\Core\Models\Domain\Attributes;


use App\Core\Contracts\IAggregableByAttributeAggregator;
use App\Core\Enums\AttributeType;

class NumberAttribute extends Attribute implements IAggregableByAttributeAggregator {

  public function __construct() {
    $this->initialize(AttributeType::NUMBER);
  }

  protected function buildSettings() {
    $this->settings = [
      'valueMin' => NULL,
      'valueMax' => NULL,
      'required' => NULL,
    ];
  }

  public function getOperationalValue(string $operation) {
    return $this->getValue();
  }

  public function getValue() {
    return (float) $this->value;
  }
}
