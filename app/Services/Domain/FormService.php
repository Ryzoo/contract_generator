<?php

namespace App\Services\Domain;

use App\Models\Domain\Contract;
use App\Models\Domain\Form;
use App\Models\Domain\FormInput;
use App\Repository\Domain\ConditionalRepository;
use App\Repository\Domain\FormRepository;
use Illuminate\Support\Collection;

class FormService {
    /**
     * @var ConditionalService
     */
    private $conditionalService;

    /**
     * @var \App\Repository\Domain\FormRepository
     */
    private $formRepository;

    public function __construct(ConditionalService $conditionalService, FormRepository $formRepository) {
        $this->conditionalService = $conditionalService;
        $this->formRepository = $formRepository;
    }

    public function createFromContract(Contract $contract):Form {
        $blocks = $contract->blocks;

        $attributesOrder = collect();
        foreach ($blocks as $block){
            $attributesOrder = $block->findVariable($attributesOrder);
        }

        $formInputCollection = $this->formRepository->getFormInputFromContract($contract, $attributesOrder);

        return Form::create([
            "contract_id" => $contract->id,
            "formInputs" => $formInputCollection,
        ]);
    }
}
