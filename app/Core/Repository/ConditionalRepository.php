<?php


namespace App\Core\Repository;


use App\Core\Enums\ConditionalType;
use App\Core\Models\Domain\Attributes\Attribute;
use App\Core\Models\Domain\Conditional\Conditional;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

class ConditionalRepository
{
    public function getListOfConditional(): array
    {
        $conditionalList = array();
        $conditionalTypeList = ConditionalType::getList();

        foreach ($conditionalTypeList as $value) {
            $conditionalList[] = Conditional::getConditionalByType($value);
        }

        return $conditionalList;
    }

    public function getConditionalsFromBlockWithId(Collection $blockCollection, int $startBlockId, ?Attribute $elementAttribute): Collection
    {
        $conditionalCollection = collect();
        $parentBlockId = null;

        $block = $blockCollection
            ->where('id', $startBlockId)
            ->first();

        if (isset($block)) {
            $parentBlockId = (int)$block->parentId;
        }

        if (isset($block) && $this->formElementNotFromCurrentConditional($elementAttribute, $block->conditionals)) {
            $conditionalCollection = collect($block->conditionals)->reverse();
        }

        if ($parentBlockId !== null && $parentBlockId !== 0) {
            $conditionalFromParent = self::getConditionalsFromBlockWithId($blockCollection, $parentBlockId, $elementAttribute);
            $conditionalCollection = $conditionalCollection->toBase()->merge($conditionalFromParent);
        }

        return $conditionalCollection;
    }

    private function formElementNotFromCurrentConditional(?Attribute $elementAttribute, array $conditionals): bool
    {
        if (!isset($elementAttribute) || empty($conditionals)) return true;

        foreach ($conditionals as $conditional) {
            $conditionalVariablesList = $conditional->getUsedVariable();
            foreach ($conditionalVariablesList as $arrayElement) {
                if( (string)$arrayElement === (string)$elementAttribute->id) return false;
            }
        }

        return true;
    }
}
