<?php


namespace App\Core\Models\Domain\Attributes;


use App\Core\Contracts\IAggregableByAttributeAggregator;
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

  public function getOperationalValue(string $operation) {
    return collect($this->value)->map(static function($value){ return (float) $value; })->sum();
  }

  public function valueParser($value) {
    return (bool) $this->settings['isMultiUse'] ? MultiRender::renderToHTML($value, $this->settings['multiUseRenderType'], false) : (float) $value;
  }
}
