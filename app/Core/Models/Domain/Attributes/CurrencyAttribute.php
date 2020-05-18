<?php


namespace App\Core\Models\Domain\Attributes;


use App\Core\Contracts\IAggregableByAttributeAggregator;
use App\Core\Enums\AggregateOperationType;
use App\Core\Enums\AttributeType;
use App\Core\Enums\MultiUseRenderType;
use App\Core\Helpers\MultiRender;
use NumberToWords\NumberToWords;

class CurrencyAttribute extends Attribute implements IAggregableByAttributeAggregator {
  public function __construct() {
    $this->initialize(AttributeType::CURRENCY);

    if(is_array($this->value)){
      $this->value['words'] = $this->getWords();
    }
  }

  protected function buildSettings():void {
    $this->settings = [
      'isInline' => FALSE,
      'isMultiUse' => FALSE,
      'valueMin' => NULL,
      'valueMax' => NULL,
      'required' => FALSE,
      'multiUseRenderType' => MultiUseRenderType::COMMA_SEPARATED,
      'renderFloatAsText' => FALSE,
    ];
  }

  public function valueParser($value) {
    return (bool) $this->settings['isMultiUse'] ? MultiRender::renderToHTML($value['number'], $this->settings['multiUseRenderType'], false) : (float) $value['number'];
  }

  public function getWords() {
    $numberToWords = new NumberToWords();
    $currencyTransformer = $numberToWords->getCurrencyTransformer('pl');
    $currency = $this->value['currency'];
    $number = (float)$this->value['number'];

    if(!$this->settings['renderFloatAsText']){
      $intNumber = (int)$number;
      $floatNumber = $number - $intNumber;
      $floatNumber = $floatNumber > 0 ? round($floatNumber * 100) : $floatNumber;
      return $currencyTransformer->toWords($intNumber * 100, $currency) . ($floatNumber > 0 ? " $floatNumber/100" : '');
    }

    return $currencyTransformer->toWords($number * 100, $currency);
  }

  public function getOperationalValue(string $operation) {
    $returnValue = 0;
    $self = $this;

    if ((bool) $this->settings['isMultiUse']) {
      collect($this->value)->map(static function($value)use(&$returnValue, $operation, $self){
          $returnValue = $self->aggregateValue($returnValue, $operation, (float) $value['number']);
      });
    }
    else {
        $returnValue = $this->aggregateValue($returnValue, $operation, (float) $this->value['number']);
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
