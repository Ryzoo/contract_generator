<?php


namespace App\Core\Models\Domain\Attributes;


use App\Core\Enums\AttributeType;
use App\Core\Enums\MultiUseRenderType;
use App\Core\Helpers\MultiRender;
use Illuminate\Support\Carbon;

class DateAttribute extends Attribute {

  public function __construct() {
    $this->initialize(AttributeType::DATE);
  }

  protected function buildSettings():void {
    $this->settings = [
      'isInline' => FALSE,
      'isMultiUse' => FALSE,
      'valueMin' => NULL,
      'valueMax' => NULL,
      'required' => FALSE,
      'defaultFormat' => 'd.m.Y',
      'multiUseRenderType' => MultiUseRenderType::COMMA_SEPARATED,
    ];
  }

  public function valueParser($value) {
    $preparedValue = $this->prepareValue($value);
    return (bool) $this->settings['isMultiUse'] ? MultiRender::renderToHTML($preparedValue, $this->settings['multiUseRenderType'], false) : $preparedValue;
  }

  private function prepareValue($value) {
    $self = $this;
    if((bool) $this->settings['isMultiUse']){
      return collect($value)->map(static function($date)use($self){
        return (new Carbon($date))->format($self->settings['defaultFormat']);
      })->toArray();
    }

    return isset($value) ? (new Carbon($value))->format($this->settings['defaultFormat']) : $value;
  }
}
