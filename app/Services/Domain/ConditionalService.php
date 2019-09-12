<?php


namespace App\Services\Domain;


use App\Models\Domain\Contract;
use App\Models\Domain\FormElements\FormElement;
use App\Repository\Domain\ConditionalRepository;
use Illuminate\Support\Collection;

class ConditionalService {
    /**
     * @var \App\Repository\Domain\ConditionalRepository
     */
    private $conditionalRepository;

    public function __construct(ConditionalRepository $conditionalRepository) {
        $this->conditionalRepository = $conditionalRepository;
    }

    public function initializeFormElementsConditional(Contract $contract, Collection $elementsCollection):Collection {
        $blockCollection = $contract->getBlockCollection();
        $formCollection = collect();

        /** @var FormElement $element */
        foreach ($elementsCollection as $element){
            $conditionals = $this->conditionalRepository
                ->getConditionalsFromBlockWithId($blockCollection, $element->parentBlockId);

            $element->conditionals = collect(array_reverse($conditionals->toArray()));
            $formCollection->push($element);
        }

        return $formCollection;
    }
}
