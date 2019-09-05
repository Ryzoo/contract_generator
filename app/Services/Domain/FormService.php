<?php

namespace App\Services\Domain;

use App\Models\Domain\Contract;
use App\Models\Domain\Form;
use App\Models\Domain\FormInput;
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

        $attributesOrder = collect();
        foreach ($blocks as $block){
            $attributesOrder = $block->findVariable($attributesOrder);
        }

        $formInputCollection = self::getFormInputFromContract($contract, $attributesOrder);

        return Form::create([
            "contract_id" => $contract->id,
            "formInputs" => $formInputCollection,
        ]);
    }

    public function getFormInputFromContract(Contract $contract, Collection $attributesOrder):Collection {
        $blockCollection = $contract->getBlockCollection();
        $formCollection = collect();

        foreach ($attributesOrder as $attributeData){
            $blockId = $attributeData[0];
            $attributeId = $attributeData[1];
            $attribute = $contract->getAttributeByID($attributeId);
            $attributeConditionals = $this->conditionalService
                ->findConditionalsInBlockFromId($blockCollection, $blockId);

            $attribute->conditionals = array_reverse($attributeConditionals->toArray());

            $formCollection->push(new FormInput($attribute));
        }

        return $formCollection;
    }
}
