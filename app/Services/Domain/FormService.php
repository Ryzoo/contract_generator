<?php

namespace App\Services\Domain;

use App\Enums\ElementType;
use App\Models\Domain\Contract;
use App\Models\Domain\Form;
use Illuminate\Support\Collection;

class FormService {

    /**
     * @var ConditionalService
     */
    private $conditionalService;

    public function __construct(ConditionalService $conditionalService) {
        $this->conditionalService = $conditionalService;
    }

    public function createFromContract(Contract $contract):Form {
        $blocks = $contract->blocks;

        $elementsCollection = collect();

        /* @var $block \App\Models\Domain\Blocks\Block */
        foreach ($blocks as $block){
            $elements = $this->reduceElementsWithSameAttribute($block->getFormElements($contract), $elementsCollection);
            $elementsCollection = $elementsCollection->merge($elements);
        }
        $elementsCollection = $elementsCollection->unique();

        $elementsCollection = $this->conditionalService
            ->initializeFormElementsConditional($contract, $elementsCollection);

        return Form::create([
            "contract_id" => $contract->id,
            "formElements" => $elementsCollection,
        ]);
    }

    private function reduceElementsWithSameAttribute(Collection $newElements, Collection $existElements): Collection {
        return $newElements->reject(function ($value, $key) use($existElements){

            if($value->elementType === ElementType::ATTRIBUTE){
                return $existElements->some(function($item) use($value){
                    if($item->elementType !== ElementType::ATTRIBUTE)
                        return false;

                    return $value->attribute == $item->attribute;
                });
            }

            return false;
        });
    }
}
