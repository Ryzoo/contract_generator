<?php


namespace App\Core\Models\Domain\Attributes;


use App\Core\Contracts\Domain\IAttribute;
use App\Core\Enums\AttributeType;

class RepeatGroupAttribute extends Attribute {

    public function __construct() {
        $this->initialize(AttributeType::REPEAT_GROUP);
    }

    protected function buildSettings() {
        $this->settings = [
            "lengthMin" => null,
            "lengthMax" => null,
            "required" => NULL,
        ];
    }

    public function getValue() {
        $attributesValue = collect();
        $attributesName = collect();

        foreach ($this->value as $attributes) {
            $attributeValue = collect();

            /**
             * @var IAttribute $attribute
             */
            foreach ($attributes as $attribute) {
                if ($attributesName->count() < count($attributes)) {
                    $attributesName->push($attribute->attributeName);
                }

                $attributeValue->push($attribute->getValue());
            }

            $attributesValue->push($attributeValue);
        }

        return $this->prepareHTMLTable($attributesValue, $attributesName);
    }

    private function prepareHTMLTable($itemsList, $headers) {
        $header = "<tr>";
        foreach ($headers as $item){
            $header .= "<th>$item</th>";
        }
        $header .= "</tr>";

        $body = "";
        foreach ($itemsList as $items){
            $body .= "<tr>";
            foreach ($items as $item){
                $body .= "<td>$item</td>";
            }
            $body .= "</tr>";
        }


        return "<br/><table>
                    <thead>
                        $header
                    </thead>
                    <tbody>
                        $body
                    </tbody>
                 </table>";
    }
}
