<?php


namespace App\Core\Helpers;


use App\Core\Enums\ElementType;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

class AttributeResolver {
    /**
     * @var \Illuminate\Support\Collection
     */
    private $formElements;

    public function __construct(Collection $formElements) {
        $this->formElements = $formElements;
    }

    public function resolveText(string $text) {
        preg_match_all('/{(\d+)}/', $text, $attributeIdList);

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

        $value = isset($attribute) ? $attribute->getValue() : "";

        return $this->escapeValue($value);
    }

    private function escapeValue( string $value) {
        if(Str::endsWith($value, "'") && Str::startsWith($value, "'"))
            $value = Str::substr($value,1, Str::length($value) - 2 );

        return $value;
    }
}
