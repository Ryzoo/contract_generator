<?php

namespace App\Core\Helpers\Parsers\Operators;

use App\Core\Helpers\Parsers\OperatorType;

class DefaultParser
{
    public static function parse($variable, $operatorType, $value):string
    {
        switch ($operatorType) {
            case OperatorType::EQUAL:
                return "${variable} === ${value}";
            case OperatorType::N_EQUAL:
                return "${variable} !== ${value}";
            case OperatorType::CONTAINS:
                return "strpos(${variable},${value}) !== false";
            case OperatorType::N_CONTAINS:
                return "strpos(${variable},${value}) === false";
            case OperatorType::EMPTY:
                return "!${variable} && ${variable} !== 0 && ${variable} !== '0'";
            case OperatorType::N_EMPTY:
                return "!!${variable} || ${variable} === 0 || ${variable} !== '0'";
            case OperatorType::BEGINS_WITH:
                return "substr($variable, 0, strlen($value)) === $value";
            case OperatorType::ENDS_WITH:
                return "(strlen($value) == 0 || substr($variable, -strlen($value)) === $value)";
            case OperatorType::GREATER:
                return "strlen(${variable}) > intval(${value})";
            case OperatorType::GREATER_OR_EQUAL:
                return "strlen(${variable}) >= intval(${value})";
            case OperatorType::SMALLER:
                return "strlen(${variable}) < intval(${value})";
            case OperatorType::SMALLER_OR_EQUAL:
                return "strlen(${variable}) <= intval(${value})";
        }
        return '';
    }
}
