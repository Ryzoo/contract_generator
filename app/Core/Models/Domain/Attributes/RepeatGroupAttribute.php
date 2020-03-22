<?php


namespace App\Core\Models\Domain\Attributes;


use App\Core\Contracts\IAggregableByAttributeAggregator;
use App\Core\Enums\AggregateOperationType;
use App\Core\Enums\AttributeType;
use App\Core\Helpers\MultiRender;

class RepeatGroupAttribute extends Attribute implements IAggregableByAttributeAggregator {

  public function __construct() {
    $this->initialize(AttributeType::ATTRIBUTE_GROUP);
  }

  protected function buildSettings() {
    $this->settings = [
      'lengthMin' => NULL,
      'lengthMax' => NULL,
      'required' => false,
      'attributes' => [],
    ];
  }

  public function getValue() {
    return MultiRender::renderToHTML($this->value, $this->multiUseRenderType);
  }

  public function getOperationalValue(string $operation) {
    $returnValue = null;

    foreach ($this->value as $attributes) {
      foreach ($attributes as $attribute) {
        $attributeParse = Attribute::getFromString((array) $attribute);
        if($attributeParse instanceof IAggregableByAttributeAggregator && !($attributeParse instanceof self) ){
          $returnValue = $this->aggregateValue($returnValue, $operation, $attributeParse);
        }
      }
    }

    return $returnValue;
  }

  private function aggregateValue(?float $value, string $operator, Attribute $attribute) {
    switch ($operator) {
      case AggregateOperationType::ADD:
        $value = $this->add($value, $attribute, $operator);
        break;
      case AggregateOperationType::SUBTRACT:
        $value = $this->subtract($value, $attribute, $operator);
        break;
      case AggregateOperationType::MULTIPLY:
        $value = $this->multiply($value, $attribute, $operator);
        break;
      case AggregateOperationType::DIVIDE:
        $value = $this->divide($value, $attribute, $operator);
        break;
    }

    return $value;
  }

  public function add(?float $value, Attribute $attribute, string $operator): float {
    return isset($value) ? $value + $attribute->getOperationalValue($operator) : $attribute->getOperationalValue($operator);
  }

  public function subtract(?float $value, Attribute $attribute, string $operator):float {
    return isset($value) ? $value - $attribute->getOperationalValue($operator) : $attribute->getOperationalValue($operator);
  }

  public function multiply(?float $value, Attribute $attribute, string $operator): float {
    return isset($value) ? $value * $attribute->getOperationalValue($operator) : $attribute->getOperationalValue($operator);
  }

  public function divide(?float $value, Attribute $attribute, string $operator): float {
    $valueOp = $attribute->getOperationalValue($operator) === 0 ? 1 : $attribute->getOperationalValue($operator) ;
    return isset($value) ? $value / $valueOp : $valueOp;
  }
}
