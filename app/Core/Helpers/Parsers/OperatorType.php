<?php


namespace App\Core\Helpers\Parsers;


class OperatorType
{
    const EQUAL = 0;
    const N_EQUAL = 1;
    const CONTAINS = 2;
    const N_CONTAINS = 3;
    const EMPTY = 4;
    const N_EMPTY = 5;
    const BEGINS_WITH = 6;
    const ENDS_WITH = 7;
    const GREATER = 8;
    const GREATER_OR_EQUAL = 9;
    const SMALLER = 10;
    const SMALLER_OR_EQUAL = 11;
}
