<?php

namespace App\Services\Domain;

use App\Models\Domain\Contract;
use App\Models\Domain\Form;

class FormService {

    public function createFromContract(Contract $contract):Form {
        $blocks = $contract->blocks;
        $attributes = $contract->attributes;
        $settings = $contract->settings;

    }
}
