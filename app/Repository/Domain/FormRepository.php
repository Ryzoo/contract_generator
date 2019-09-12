<?php


namespace App\Repository\Domain;


use App\Models\Domain\Contract;
use App\Models\Domain\FormInput;
use App\Services\Domain\ConditionalService;
use Illuminate\Support\Collection;

class FormRepository {
    /**
     * @var \App\Repository\Domain\ConditionalRepository
     */
    private $conditionalRepository;

    public function __construct(ConditionalRepository $conditionalRepository) {
        $this->conditionalRepository = $conditionalRepository;
    }

    public function getFormInputFromContract(Contract $contract, Collection $attributesOrder):Collection {
        $blockCollection = $contract->getBlockCollection();
        $formCollection = collect();

        foreach ($attributesOrder as $attributeData){
            $blockId = $attributeData[0];
            $attributeId = $attributeData[1];
            $attribute = $contract->getAttributeByID($attributeId);
            $attributeConditionals = $this->conditionalRepository
                ->getConditionalsFromBlockWithId($blockCollection, $blockId);

            $attribute->conditionals = array_reverse($attributeConditionals->toArray());

            $formCollection->push(new FormInput($attribute));
        }

        return $formCollection;
    }
}
