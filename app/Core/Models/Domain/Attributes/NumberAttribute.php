<?php


namespace App\Core\Models\Domain\Attributes;


use App\Core\Contracts\IAggregableByAttributeAggregator;
use App\Core\Enums\AggregateOperationType;
use App\Core\Enums\AttributeType;
use App\Core\Enums\MultiUseRenderType;
use App\Core\Helpers\MultiRender;

class NumberAttribute extends Attribute implements IAggregableByAttributeAggregator {

  public function __construct() {
    $this->initialize(AttributeType::NUMBER);
  }

  protected function buildSettings() {
    $this->settings = [
      'isInline' => FALSE,
      'isMultiUse' => FALSE,
      'valueMin' => NULL,
      'valueMax' => NULL,
      'required' => FALSE,
      'multiUseRenderType' => MultiUseRenderType::COMMA_SEPARATED,
    ];
  }

  public function valueParser($value) {
    return (bool) $this->settings['isMultiUse'] ? MultiRender::renderToHTML($value, $this->settings['multiUseRenderType'], false) : (float) $value;
  }

  public function getOperationalValue(string $operation) {
    $returnValue = 0;
    $self = $this;

    if ((bool) $this->settings['isMultiUse']) {
      collect($this->value)->map(static function($value)use(&$returnValue, $operation, $self){
          $returnValue = $self->aggregateValue($returnValue, $operation, (float) $value);
      });
    }
    else {
        $returnValue = $this->aggregateValue($returnValue, $operation, (float) $this->value);
    }

    return $returnValue;
  }

  private function aggregateValue(?float $value, $operator, float $number) {
    switch ($operator) {
      case AggregateOperationType::ADD:
        $value = $this->add($value, $number);
        break;
      case AggregateOperationType::SUBTRACT:
        $value = $this->subtract($value, $number);
        break;
      case AggregateOperationType::MULTIPLY:
        $value = $this->multiply($value, $number);
        break;
      case AggregateOperationType::DIVIDE:
        $value = $this->divide($value, $number);
        break;
    }

    return $value;
  }

  public function add(?float $value, float $number): float {
    return isset($value) ? $value + $number : $number;
  }

  public function subtract(?float $value, float $number): float {
    return isset($value) ? $value - $number : $number;
  }

  public function multiply(?float $value, float $number): float {
    return isset($value) ? $value * $number : $number;
  }

  public function divide(?float $value, float $number): float {
    $valueOp = (int) $number === 0 ? 1 : $number;
    return isset($value) ? $value / $valueOp : $valueOp;
  }
}
