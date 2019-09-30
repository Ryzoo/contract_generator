<?php


namespace App\Helpers;


use App\Enums\ElementType;
use Illuminate\Support\Collection;

class AttributeResolver {
    /**
     * @var \Illuminate\Support\Collection
     */
    private $formElements;

    public function __construct(Collection $formElements) {
        $this->formElements = $formElements;
    }

    public function resolveText(string $text) {
        preg_match_all('/{(\d)}/', $text, $attributeIdList);

        foreach ($attributeIdList[1] as $id){
            $value = $this->getAttributeValueById(intval($id));
            $text = str_replace("{".$id."}",$value, $text);
        }

        return $text;
    }

    private function getAttributeValueById(int $id){
        $attribute = $this->formElements
            ->where("elementType", ElementType::ATTRIBUTE)
            ->map(function($e){
                return $e->attribute;
            })
            ->where("id", $id)
            ->first();

        return isset($attribute) ? $attribute->getValue() : "";
    }
}
