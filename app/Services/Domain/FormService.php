<?php

namespace App\Services\Domain;

use App\Models\Domain\Contract;
use App\Models\Domain\Form;

class FormService {

    public function createFromContract(Contract $contract):Form {
        $attributes = $contract->attributes;
        $blocks = $contract->blocks;
        $settings = $contract->settings;


    }
}
