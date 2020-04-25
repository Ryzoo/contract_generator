<?php


namespace App\Core\Repository;


use App\Core\Enums\AttributeType;
use App\Core\Models\Domain\Attributes\Attribute;

class AttributeRepository {
    public function getListOfAttributes():array {
        $attributeList = array();
        $attributeTypeList = AttributeType::getList();

        foreach($attributeTypeList as $value){
            $attributeList[] = Attribute::getAttributeByType($value);
        }

        return $attributeList;
    }
}
