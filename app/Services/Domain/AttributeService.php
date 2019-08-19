<?php


namespace App\Services\Domain;


use App\Contracts\Domain\IAttribute;
use App\Enums\AttributeType;
use App\Models\Domain\Attributes\Attribute;
use App\Models\Domain\Attributes\NumberAttribute;
use Intervention\Image\Exception\NotFoundException;

class AttributeService {

    public function getListOfAttributes():array {
        $attributeList = array();
        $attributeTypeList = AttributeType::getList();

        foreach($attributeTypeList as $value){
            array_push($attributeList, Attribute::getAttributeByType($value));
        }

        return $attributeList;
    }

}
