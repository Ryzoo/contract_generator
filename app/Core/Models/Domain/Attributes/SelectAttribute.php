<?php


namespace App\Core\Models\Domain\Attributes;


use App\Core\Enums\AttributeType;
use App\Core\Enums\MultiUseRenderType;
use App\Core\Helpers\MultiRender;

class SelectAttribute extends Attribute
{

    public function __construct()
    {
        $this->initialize(AttributeType::SELECT);
    }

    protected function buildSettings(): void
    {
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

    public function getValueAsArray()
    {
        return explode('|,', $this->value);
    }

    public function valueParser($value)
    {
        $newValue = $this->prepareValue($value);
        return ((bool)$this->settings['isMultiUse']) ? MultiRender::renderToHTML($newValue, $this->settings['multiUseRenderType'], false) : $newValue;
    }

    private function prepareValue($value)
    {
        $preparedValue = '';
        if (!is_array($value)) {
            $valueList = explode('|,', $value);
            switch ((int)$this->settings['listRenderType']) {
                case MultiUseRenderType::COMMA_SEPARATED:
                    $preparedValue = implode(', ', $valueList);
                    break;
                case MultiUseRenderType::LIST:
                case MultiUseRenderType::LIST_NUMBER:
                case MultiUseRenderType::LIST_ALFA:
                    $content = '';
                    foreach ($valueList as $value) {
                        $content .= "<li>$value</li>";
                    }
                    switch ((int)$this->settings['listRenderType']){
                        case MultiUseRenderType::LIST:
                            $preparedValue .= "<ul width='100%' style='list-style-type: disc;'>$content</ul>";
                            break;
                        case MultiUseRenderType::LIST_NUMBER:
                            $preparedValue .= "<ol width='100%' style='list-style-type: decimal;'>$content</ol>";
                            break;
                        case MultiUseRenderType::LIST_ALFA:
                            $preparedValue .= "<ol width='100%' style='list-style-type: lower-alpha;'>$content</ol>";
                            break;
                    }
                    break;
                case MultiUseRenderType::TABLE:
                    $preparedValue .= '<table>';
                    foreach ($valueList as $value) {
                        $preparedValue .= '<tr>';
                        $preparedValue .= "<td>$value</td>";
                        $preparedValue .= '</tr>';
                    }
                    $preparedValue .= '</table>';
                    break;
            }
        } else {
            $preparedValue = implode('|,', $value);
            $preparedValue = $this->prepareValue($preparedValue);
        }

        return $preparedValue;
    }
}
