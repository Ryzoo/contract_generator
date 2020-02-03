<?php


namespace App\Core\Helpers\Parsers;


class OperatorType
{
    public const EQUAL = 0;
    public const N_EQUAL = 1;
    public const CONTAINS = 2;
    public const N_CONTAINS = 3;
    public const EMPTY = 4;
    public const N_EMPTY = 5;
    public const BEGINS_WITH = 6;
    public const ENDS_WITH = 7;
    public const GREATER = 8;
    public const GREATER_OR_EQUAL = 9;
    public const SMALLER = 10;
    public const SMALLER_OR_EQUAL = 11;
}
