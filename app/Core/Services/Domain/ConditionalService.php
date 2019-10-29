<?php


namespace App\Core\Services\Domain;


use App\Core\Models\Domain\Contract;
use App\Core\Models\Domain\FormElements\FormElement;
use App\Core\Repository\Domain\ConditionalRepository;
use Illuminate\Support\Collection;

class ConditionalService {
    /**
     * @var \App\Core\Repository\Domain\ConditionalRepository
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
