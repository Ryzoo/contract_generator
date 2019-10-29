<?php


namespace App\Core\Enums;

use App\Core\Traits\EnumIterator;

class AttributeType {
    use EnumIterator;

    public const NUMBER = 0;
    public const TEXT = 1;
    public const SELECT = 2;
}
