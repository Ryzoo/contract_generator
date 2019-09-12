<?php


namespace App\Repository\Domain;


use App\Enums\AttributeType;
use App\Models\Domain\Attributes\Attribute;

class AttributeRepository {

    public function getListOfAttributes():array {
        $attributeList = array();
        $attributeTypeList = AttributeType::getList();

        foreach($attributeTypeList as $value){
            array_push($attributeList, Attribute::getAttributeByType($value));
        }

        return $attributeList;
    }
}
