<?php


namespace App\Core\Enums\Modules;

use App\Core\Traits\EnumIterator;

class AuthType {
    use EnumIterator;

    public const ALL = 0;
    public const LOGIN = 1;
    public const PASSWORD = 2;
}

