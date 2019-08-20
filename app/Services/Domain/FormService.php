<?php

namespace App\Services\Domain;

use App\Helpers\Response;
use App\Models\Domain\Contract;
use App\Models\Domain\Form;
use App\Models\Domain\FormInput;
use Illuminate\Support\Collection;

class FormService {

    public function createFromContract(Contract $contract):Form {
        $blocks = $contract->blocks;

        $attributesOrder = collect();
        foreach ($blocks as $block){
            $attributesOrder = $block->findVariable($attributesOrder);
        }

        return Form::create([
            "contract_id" => $contract->id,
            "attributesOrder" => $attributesOrder,
        ]);
    }

    public function getContractFormForRender(Contract $contract):Collection {
        $form = $contract->form;
        $attributesOrder = $form->attributesOrder;

        if(!isset($form))
            Response::error(_("validation.custom.form.not_exist"), 404);

        $formCollection = collect();
        foreach ($attributesOrder as $attributeID){
            $attribute = $contract->getAttributeByID($attributeID);
            $formCollection->push(new FormInput($attribute));
        }

        return $formCollection;
    }
}
