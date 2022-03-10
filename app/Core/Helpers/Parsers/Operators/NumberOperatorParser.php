<?php

namespace App\Core\Helpers\Parsers\Operators;

use App\Core\Helpers\Parsers\OperatorType;

class NumberOperatorParser extends DefaultParser
{
    public static function parse($variable, $operatorType, $value):string
    {
        switch ($operatorType) {
            case OperatorType::CONTAINS:
                return "strpos('${variable}','${value}') !== false";
            case OperatorType::N_CONTAINS:
                return "strpos('${variable}','${value}') === false";
            case OperatorType::EMPTY:
                return "('$variable' === 'null')";
            case OperatorType::N_EMPTY:
                return "('$variable' !== 'null')";
            case OperatorType::BEGINS_WITH:
                return "Str::startsWith('${variable}', '${value}')";
            case OperatorType::ENDS_WITH:
                return "Str::endsWith('${variable}', '${value}')";
            case OperatorType::GREATER:
                return "'$variable' !== 'null' && intval(${variable}) > ${value}";
            case OperatorType::GREATER_OR_EQUAL:
                return "'$variable' !== 'null' && intval(${variable}) >= ${value}";
            case OperatorType::SMALLER:
                return "'$variable' !== 'null' && intval(${variable}) < ${value}";
            case OperatorType::SMALLER_OR_EQUAL:
                return "'$variable' !== 'null' && intval(${variable}) <= ${value}";
            case OperatorType::EQUAL:
              return "'$variable' === '$value'";
            case OperatorType::N_EQUAL:
              return "'$variable' !== '$value'";
        }
        return DefaultParser::parse($variable, $operatorType, $value);
    }
}
