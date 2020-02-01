<?php


namespace App\Core\Enums\Modules;

use App\Core\Traits\EnumIterator;

class ContractModulesAvailablePlace {
    use EnumIterator;

    public const PRE_FORM = 0;
    public const POST_FORM = 1;
    public const FINISHER = 2;
}

