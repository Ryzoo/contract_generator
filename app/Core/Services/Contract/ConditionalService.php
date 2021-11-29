<?php


namespace App\Core\Services\Contract;


use App\Core\Models\Database\Contract;
use App\Core\Models\Domain\FormElements\FormElement;
use App\Core\Repository\ConditionalRepository;
use Illuminate\Support\Collection;

class ConditionalService {
    private ConditionalRepository $conditionalRepository;

    public function __construct(ConditionalRepository $conditionalRepository) {
        $this->conditionalRepository = $conditionalRepository;
    }

    public function initializeConditionalInFormElementsCollection(Contract $contract, Collection $formElementsCollection):Collection {
        $blockCollection = $contract->getBlockCollection();
        $formCollection = clone $formElementsCollection;

        /** @var FormElement $element */
        foreach ($formCollection as &$element){
            $conditionals = $this->conditionalRepository
                ->getConditionalsFromBlockWithId($blockCollection, $element->parentBlockId, $element->attribute ?? null);
            $element->conditionals = collect(array_reverse($conditionals->unique()->toArray()))->filter()->toArray();
        }

        return $formCollection;
    }

}
