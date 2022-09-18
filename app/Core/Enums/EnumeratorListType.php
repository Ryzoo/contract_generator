<?php


namespace App\Core\Enums;

use App\Core\Traits\EnumIterator;

class EnumeratorListType
{

    use EnumIterator;

    public const DOT = 0;
    public const DECIMAL = 1;
    public const LOVER_ALPHA = 2;
    public const UPPER_ROMAN = 3;
    public const LOWER_ROMAN = 4;
}
