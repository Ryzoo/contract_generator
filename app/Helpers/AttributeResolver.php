<?php


namespace App\Helpers;


class AttributeResolver {

    /**
     * @var array
     */
    private $attributes;

    public function __construct(array $attributes) {
        $this->attributes = $attributes;
    }

    public function resolveText(string $text) {
        preg_match_all('/{(\d)}/', $text, $attributeIdList);

        foreach ($attributeIdList as $attribute){
            $id = $attribute[0];
            $value = $this->getAttributeValueById(intval($id));
            $text = str_replace("{".$id."}",$value, $text);
        }

        return $text;
    }

    private function getAttributeValueById(int $id){
        foreach ($this->attributes as $attribute){
            if(intval($attribute->id) === $id)
                return $attribute->getValue();
        }

        return "";
    }
}
