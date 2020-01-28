<?php


namespace App\Core\Repository;


use App\Core\Enums\ConditionalType;
use App\Core\Models\Domain\Conditional\Conditional;
use Illuminate\Support\Collection;

class ConditionalRepository {
    public function getListOfConditional():array {
        $conditionalList = array();
        $conditionalTypeList = ConditionalType::getList();

        foreach($conditionalTypeList as $value){
            array_push($conditionalList,Conditional::getConditionalByType($value));
        }

        return $conditionalList;
    }

    public function getConditionalsFromBlockWithId(Collection $blockCollection, int $startBlockId): Collection{
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
            $conditionalFromParent = self::getConditionalsFromBlockWithId($blockCollection, $parentBlockId);
            $conditionalCollection = $conditionalCollection->toBase()->merge( $conditionalFromParent );
        }

        return $conditionalCollection;
    }
}
