<?php


namespace App\Core\Models\Domain\Attributes;


use App\Core\Enums\AttributeType;
use App\Core\Enums\MultiUseRenderType;
use App\Core\Helpers\MultiRender;

class DateAttribute extends Attribute {

  public function __construct() {
    $this->initialize(AttributeType::DATE);
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
    return (bool) $this->settings['isMultiUse'] ? MultiRender::renderToHTML($value, $this->settings['multiUseRenderType'], false) : $value;
  }
}
