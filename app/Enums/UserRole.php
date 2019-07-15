<?php


namespace App\Enums;


use App\Contracts\EnumIterator;

class UserRole {
    use EnumIterator;

    public const CLIENT = 0;
    public const ADMIN = 1;
}