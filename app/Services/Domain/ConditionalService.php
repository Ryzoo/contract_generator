<?php


namespace App\Services\Domain;


use App\Contracts\Domain\IConditional;
use App\Enums\ConditionalType;
use App\Models\Domain\Conditional\ShowOn;
use Intervention\Image\Exception\NotFoundException;

class ConditionalService {

    public function getListOfConditional():array {
        $conditionalList = array();
        $conditionalTypeList = ConditionalType::getList();

        foreach($conditionalTypeList as $value){
            array_push($conditionalList,$this->getConditionalByType($value));
        }

        return $conditionalList;
    }

    public function getConditionalByType(int $conditionalType):IConditional {
        switch ($conditionalType)
        {
            case ConditionalType::SHOW_ON:
                return new ShowOn();
        }

        throw new NotFoundException("Conditional {$conditionalType} was not found");
    }

}
