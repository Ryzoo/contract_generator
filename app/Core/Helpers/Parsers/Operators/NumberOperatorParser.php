<?php

namespace App\Core\Helpers\Parsers\Operators;

use App\Core\Helpers\Parsers\OperatorType;

class NumberOperatorParser extends DefaultParser
{
    static function parse($variable, $operatorType, $value)
    {
        switch ($operatorType) {
            case OperatorType::CONTAINS:
                return "strpos('${variable}','${value}') !== false";
            case OperatorType::N_CONTAINS:
                return "strpos('${variable}','${value}') === false";
            case OperatorType::EMPTY:
                return "(!${variable} && ${variable} !== 0)";
            case OperatorType::N_EMPTY:
                return "(!!${variable} || ${variable} !== 0)";
            case OperatorType::BEGINS_WITH:
                return "startsWith('${variable}', '${value}')";
            case OperatorType::ENDS_WITH:
                return "endsWith('${variable}', '${value}')";
            case OperatorType::GREATER:
                return "intval(${variable}) > ${value}";
            case OperatorType::GREATER_OR_EQUAL:
                return "intval(${variable}) >= ${value}";
            case OperatorType::SMALLER:
                return "intval(${variable}) < ${value}";
            case OperatorType::SMALLER_OR_EQUAL:
                return "intval(${variable}) <= ${value}";
        }
        return DefaultParser::parse($variable, $operatorType, $value);
    }
}
