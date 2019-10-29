<?php


namespace App\Core\Enums;


use App\Core\Traits\EnumIterator;

class UserRole {
    use EnumIterator;

    public const CLIENT = 0;
    public const ADMIN = 1;
}
