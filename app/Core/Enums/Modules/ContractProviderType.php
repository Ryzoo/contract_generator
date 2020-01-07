<?php


namespace App\Core\Enums\Modules;

use App\Core\Traits\EnumIterator;

class ContractProviderType {
    use EnumIterator;

    public const RENDER = 0;
    public const EMAIL = 1;
}
