<?php


namespace App\Core\Models\Domain\Attributes;


use App\Core\Contracts\IAttribute;
use App\Core\Enums\AttributeType;
use App\Core\Models\Domain\FormElements\FormElement;
use Psy\Util\Json;

class RepeatGroupAttribute extends Attribute {

    public function __construct() {
        $this->initialize(AttributeType::REPEAT_GROUP);
    }

    protected function buildSettings() {
        $this->settings = [
            'lengthMin' => null,
            'lengthMax' => null,
            'required' => NULL,
        ];
    }

    public function getValue() {
        $attributesValue = collect();
        $attributesName = collect();

        foreach ($this->value as $attributes) {
            $attributeValue = collect();

            /**
             * @var Attribute $attribute
             */
            foreach ($attributes as $attribute) {
                $attributeParse = Attribute::getFromString((array) $attribute);

                if ($attributesName->count() < count($attributes)) {
                    $attributesName->push($attributeParse->attributeName);
                }

                $attributeValue->push($attributeParse->getValue());
            }

            $attributesValue->push($attributeValue);
        }

        return $this->prepareHTMLTable($attributesValue, $attributesName);
    }

    private function prepareHTMLTable($itemsList, $headers) {
        $header = '<tr>';
        foreach ($headers as $item){
            $header .= "<th>$item</th>";
        }
        $header .= '</tr>';

        $body = '';
        foreach ($itemsList as $items){
            $body .= '<tr>';
            foreach ($items as $item){
                $body .= "<td>$item</td>";
            }
            $body .= '</tr>';
        }

        return "<br/><table><thead>$header</thead><tbody>$body</tbody></table>";
    }
}
