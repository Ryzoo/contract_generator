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
      'listRenderType' => MultiUseRenderType::COMMA_SEPARATED,
    ];
  }

  public function valueParser($value) {
    $newValue = $this->prepareValue($value);
    return (bool) $this->settings['isMultiUse'] ? MultiRender::renderToHTML($newValue, $this->settings['multiUseRenderType'], false) : $newValue;
  }

  private function prepareValue($value) {
    $preparedValue = '';
    if(!is_array($value)){
      $valueList = explode('|,', $value);
      switch ((int)$this->settings['listRenderType']){
        case MultiUseRenderType::COMMA_SEPARATED:
          $preparedValue = implode(', ', $valueList);
          break;
        case MultiUseRenderType::LIST:
          $preparedValue .= '';
          $preparedValue .= '<ul>';
          foreach($valueList as $value) {
            $preparedValue .= "<li>{$value}</li>";
          }
          $preparedValue .= '</ul>';
          break;
        case MultiUseRenderType::TABLE:
          $preparedValue .= '<table>';
          foreach($valueList as $value) {
            $preparedValue .= '<tr>';
            $preparedValue .= "<td>{$value}</td>";
            $preparedValue .= '</tr>';
          }
          $preparedValue .= '</table>';
          break;
      }
    }else{
      $preparedValue = implode('|,', $value);
      $preparedValue = $this->prepareValue($preparedValue);
    }

    return $preparedValue;
  }
}
