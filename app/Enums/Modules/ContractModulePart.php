<?php


namespace App\Enums\Modules;

use App\Traits\EnumIterator;

class ContractModulePart {
    use EnumIterator;

    public const GET_CONTRACT = 0;
    public const RENDER_CONTRACT = 1;
}

