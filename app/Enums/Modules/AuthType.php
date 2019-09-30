<?php


namespace App\Enums\Modules;

use App\Traits\EnumIterator;

class AuthType {
    use EnumIterator;

    public const ALL = 0;
    public const LOGIN = 1;
    public const PASSWORD = 2;
}

