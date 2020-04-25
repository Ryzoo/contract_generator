<?php


namespace App\Core\Models\Domain\Attributes;


use App\Core\Contracts\IAggregableByAttributeAggregator;
use App\Core\Enums\AggregateOperationType;
use App\Core\Enums\AttributeType;
use App\Core\Enums\ElementType;
use App\Core\Enums\MultiUseRenderType;
use App\Core\Helpers\AttributeResolver;
use App\Core\Helpers\OperationalAttributeResolver;
use Illuminate\Support\Collection;

class AggregateAttribute extends Attribute {

  public function __construct() {
    $this->initialize(AttributeType::AGGREGATE);
  }

  protected function buildSettings():void {
    $this->settings = [
      'isInline' => FALSE,
      'isMultiUse' => FALSE,
      'operationReturnFormatType' => 'float',
      'precision' => 2,
      'operationItems' => [],
      'operationType' => AggregateOperationType::ADD,
      'multiUseRenderType' => MultiUseRenderType::COMMA_SEPARATED,
    ];
  }

  public function getValue() {
    $aggregatedValue = 0;
    switch ($this->settings['operationType']) {
      case AggregateOperationType::ADD:
        $aggregatedValue = $this->add();
        break;
      case AggregateOperationType::SUBTRACT:
        $aggregatedValue = $this->subtract();
        break;
      case AggregateOperationType::MULTIPLY:
        $aggregatedValue = $this->multiply();
        break;
      case AggregateOperationType::DIVIDE:
        $aggregatedValue = $this->divide();
        break;
    }

    return $this->settings['operationReturnFormatType'] === 'float' ? round((float) $aggregatedValue, (int) $this->settings['precision']) : (int) $aggregatedValue;
  }

  public function resolveAttributesInSettings(Collection $formElements): void {
    $items = $this->settings['operationItems'];
    $returnItems = [];

    foreach ($items as $attributeId) {
      $resolver = new OperationalAttributeResolver($formElements, $this->settings['operationType']);
      $returnItems[] = $resolver->resolveText('{' . $attributeId . '}');
    }

    $this->settings['operationItems'] = $returnItems;
  }

  public function add(): float {
    $returnValue = 0;
    foreach ($this->settings['operationItems'] as $item) {
      $returnValue += (float) $item;
    }
    return $returnValue;
  }

  public function subtract(): float {
    $returnValue = 0;
    foreach ($this->settings['operationItems'] as $key => $item) {
      if ($key === 0) {
        $returnValue = (float) $item;
      }
      else {
        $returnValue -= (float) $item;
      }
    }
    return $returnValue;
  }

  public function multiply(): float {
    $returnValue = 0;
    foreach ($this->settings['operationItems'] as $key => $item) {
      if ($key === 0) {
        $returnValue = (float) $item;
      }
      else {
        $returnValue *= (float) $item;
      }
    }
    return $returnValue;
  }

  public function divide(): float {
    $returnValue = 0;
    foreach ($this->settings['operationItems'] as $key => $item) {
      if ($item === 0) {
        continue;
      }
      if ($key === 0) {
        $returnValue = (float) $item;
      }
      else {
        $returnValue /= (float) $item;
      }
    }
    return $returnValue;
  }
}
