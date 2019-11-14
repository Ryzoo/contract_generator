<?php

namespace App\Core\Services\Domain;

use App\Core\Enums\ElementType;
use App\Core\Models\Domain\Contract;
use App\Core\Models\Domain\Form;
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

        $formElementsCollection = collect();

        /* @var $block \App\Core\Models\Domain\Blocks\Block */
        foreach ($blocks as $block){
            $elements = $this->reduceElementsWithSameAttribute($block->getFormElements($contract), $formElementsCollection);
            $formElementsCollection = $formElementsCollection->merge($elements);
        }
        $formElementsCollection = $formElementsCollection->unique();

        $formElementsCollection = $this->conditionalService
            ->initializeConditionalInFormElementsCollection($contract, $formElementsCollection);

        if(isset($contract->form)){
            $contract->form->update([
                "formElements" => $formElementsCollection,
            ]);
            return $contract->form;
        }else{
            return Form::create([
                "contract_id" => $contract->id,
                "formElements" => $formElementsCollection,
            ]);
        }
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
