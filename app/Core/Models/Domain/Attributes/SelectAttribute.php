<?php


namespace App\Core\Models\Domain\Attributes;


use App\Core\Enums\AttributeType;
use App\Core\Enums\MultiUseRenderType;
use App\Core\Helpers\MultiRender;

class SelectAttribute extends Attribute {

  public function __construct() {
    $this->initialize(AttributeType::SELECT);
  }

  protected function buildSettings():void {
    $this->settings = [
      'isInline' => FALSE,
      'isMultiUse' => FALSE,
      'isMultiSelect' => FALSE,
      'allowSelfOptions' => FALSE,
      'items' => [],
      'required' => FALSE,
      'lengthMin' => NULL,
      'lengthMax' => NULL,
      'multiUseRenderType' => MultiUseRenderType::COMMA_SEPARATED,
    ];
  }

  public function valueParser($value) {
    return (bool) $this->settings['isMultiUse'] ? MultiRender::renderToHTML($value, $this->settings['multiUseRenderType'], false) : $value;
  }
}
