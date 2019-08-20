<?php

namespace App\Services\Domain;

use App\Helpers\Response;
use App\Models\Domain\Blocks\Block;
use App\Models\Domain\Contract;
use App\Models\Domain\Form;

class FormService {

    public function createFromContract(Contract $contract):Form {

        $blocks = $contract->blocks;
        $attributes = $contract->attributes;
        $settings = $contract->settings;

        $variableOrder = collect();
        foreach ($blocks as $block){
            $variableOrder = $block->findVariable($variableOrder);
        }

        Response::json($variableOrder);
    }
}
