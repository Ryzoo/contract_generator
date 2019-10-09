<?php


namespace App\Enums\Modules;

use App\Traits\EnumIterator;

class ContractProviderType {
    use EnumIterator;

    public const RENDER = 0;
    public const EMAIL = 1;
    public const TASK = 2;
}
