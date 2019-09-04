<?php


namespace App\Services\Domain;


use App\Contracts\Domain\IConditional;
use App\Enums\ConditionalType;
use App\Models\Domain\Conditional\Conditional;
use App\Models\Domain\Conditional\ShowOn;
use Illuminate\Support\Collection;
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

    public function findConditionalsInBlockFromId(Collection $blockCollection, int $startBlockId): Collection{
        $conditionalCollection = collect();
        $parentBlockId = null;

        $block = $blockCollection
            ->where("id", $startBlockId)
            ->first();

        if(isset($block)){
            $conditionalCollection = collect($block->conditionals)->reverse();
            $parentBlockId = intval($block->parentId);
        }

        if($parentBlockId != null && $parentBlockId != 0){
            $conditionalFromParent = self::findConditionalsInBlockFromId($blockCollection, $parentBlockId);
            $conditionalCollection = $conditionalCollection->toBase()->merge( $conditionalFromParent );
        }

        return $conditionalCollection;
    }
}
