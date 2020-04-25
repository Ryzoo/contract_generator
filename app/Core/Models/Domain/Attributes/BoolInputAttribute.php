<?php


namespace App\Core\Models\Domain\Attributes;


use App\Core\Contracts\IAggregableByAttributeAggregator;
use App\Core\Enums\AggregateOperationType;
use App\Core\Enums\AttributeType;
use App\Core\Enums\MultiUseRenderType;
use App\Core\Helpers\MultiRender;

class BoolInputAttribute extends Attribute implements IAggregableByAttributeAggregator{

  public function __construct() {
    $this->initialize(AttributeType::BOOL_INPUT);
  }

  protected function buildSettings():void {
    $this->settings = [
      'required' => FALSE,
      'isInline' => FALSE,
      'isMultiUse' => FALSE,
      'boolLabel' => '',
      'inputLabel' => '',
      'multiUseRenderType' => MultiUseRenderType::COMMA_SEPARATED,
    ];
  }

  public function valueParser($value) {
    if($this->settings['isMultiUse']){
      $values = collect($value)
        ->filter(static function($v){
          return isset($v['bool'], $v['input']) && (bool) $v['bool'];
        })
        ->map(static function ($v){
          return $v['input'];
        });

      return MultiRender::renderToHTML($values->toArray(), $this->settings['multiUseRenderType'], FALSE);
    }

    if(isset($value['bool']) && (bool) $value['bool']) {
      return $value['input'];
    }

    return '';
  }

  public function getOperationalValue(string $operation) {
    $returnValue = 0;
    $self = $this;

    if ((bool) $this->settings['isMultiUse']) {
      collect($this->value)->map(static function($value)use(&$returnValue, $operation, $self){
        if((bool) $value['bool'] && is_numeric($value['input']))
          $returnValue = $self->aggregateValue($returnValue, $operation, (float) $value['input']);
      });
    }
    else {
      if((bool) $this->value['bool'] && is_numeric($this->value['input']))
        $returnValue = $this->aggregateValue($returnValue, $operation, (float) $this->value['input']);
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
