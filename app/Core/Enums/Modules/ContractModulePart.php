<?php


namespace App\Core\Enums\Modules;

use App\Core\Traits\EnumIterator;

class ContractModulePart {
    use EnumIterator;

    public const GET_CONTRACT = 0;
    public const RENDER_CONTRACT = 1;
}

