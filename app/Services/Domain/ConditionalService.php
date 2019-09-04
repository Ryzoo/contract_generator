<?php


namespace App\Services\Domain;


use App\Contracts\Domain\IConditional;
use App\Enums\ConditionalType;
use App\Models\Domain\Conditional\Conditional;
use App\Models\Domain\Conditional\ShowOn;
use Intervention\Image\Exception\NotFoundException;

class ConditionalService {

    public function getListOfConditional():array {
        $conditionalList = array();
        $conditionalTypeList = ConditionalType::getList();

        foreach($conditionalTypeList as $value){
            array_push($conditionalList,Conditional::getConditionalByType($value));
        }

        return $conditionalList;
    }

}
