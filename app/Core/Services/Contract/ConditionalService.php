<?php


namespace App\Core\Services\Contract;


use App\Core\Models\Database\Contract;
use App\Core\Models\Domain\FormElements\FormElement;
use App\Core\Repository\ConditionalRepository;
use Illuminate\Support\Collection;

class ConditionalService {
    /**
     * @var ConditionalRepository
     */
    private $conditionalRepository;

    public function __construct(ConditionalRepository $conditionalRepository) {
        $this->conditionalRepository = $conditionalRepository;
    }

    public function initializeConditionalInFormElementsCollection(Contract $contract, Collection $formElementsCollection):Collection {
        $blockCollection = $contract->getBlockCollection();
        $formCollection = collect();

        /** @var FormElement $element */
        foreach ($formElementsCollection as $element){
            $conditionals = $this->conditionalRepository
                ->getConditionalsFromBlockWithId($blockCollection, $element->parentBlockId);

            $element->conditionals = collect(array_reverse($conditionals->toArray()))->toArray();
            $formCollection->push($element);
        }

        return $formCollection;
    }

}
