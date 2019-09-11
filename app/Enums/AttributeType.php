<?php


namespace App\Enums;

use App\Traits\EnumIterator;

class AttributeType {
    use EnumIterator;

    public const NUMBER = 0;
    public const TEXT = 1;
}
