<?php


namespace App\Core\Models\Domain\Attributes;


use App\Core\Enums\AttributeType;
use App\Core\Enums\MultiUseRenderType;
use App\Core\Helpers\MultiRender;

class BoolAttribute extends Attribute {

  public function __construct() {
    $this->initialize(AttributeType::BOOL);
  }

  protected function buildSettings():void {
    $this->settings = [
      'required' => FALSE,
      'isInline' => FALSE,
      'isMultiUse' => FALSE,
      'multiUseRenderType' => MultiUseRenderType::COMMA_SEPARATED,
    ];
  }

  public function valueParser($value) {
    return (bool) $this->settings['isMultiUse'] ? MultiRender::renderToHTML($value, $this->settings['multiUseRenderType'], false) : (!isset($value) ? '0' : (string) $value);
  }
}
