<?php

namespace App\Services\Domain;

use App\Models\Domain\Contract;
use App\Models\Domain\Form;

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
            $elementsCollection->merge($block->getFormElements($contract));
        }
        $elementsCollection = $elementsCollection->uniqueStrict("1");

        $elementsCollection = $this->conditionalService
            ->initializeFormElementsConditional($contract, $elementsCollection);

        return Form::create([
            "contract_id" => $contract->id,
            "formElements" => $elementsCollection,
        ]);
    }
}
