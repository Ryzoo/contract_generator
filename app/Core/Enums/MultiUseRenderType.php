<?php


namespace App\Core\Enums;


use App\Core\Traits\EnumIterator;

class MultiUseRenderType
{

    use EnumIterator;

    public const LIST = 0;
    public const TABLE = 1;
    public const COMMA_SEPARATED = 2;
    public const LIST_NUMBER = 3;
    public const LIST_ALFA = 4;
}
