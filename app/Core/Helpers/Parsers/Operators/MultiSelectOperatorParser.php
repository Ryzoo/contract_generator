<?php

namespace App\Core\Helpers\Parsers\Operators;

use App\Core\Helpers\Parsers\OperatorType;

class MultiSelectOperatorParser extends DefaultParser
{
    public static function parse($variable, $operatorType, $value):string
    {
        switch ($operatorType) {
            case OperatorType::EQUAL:
                return "collect(explode(',',${variable})).every( x => collect(explode(',',${value})).contains(x))";
            case OperatorType::N_EQUAL:
                return "!collect(explode(',',${variable})).every( x => collect(explode(',',${value})).contains(x))";
            case OperatorType::EMPTY:
              return "count(explode(',',${variable})) <= 0";
            case OperatorType::N_EMPTY:
              return "count(explode(',',${variable})) > 0";
        }
        return DefaultParser::parse($variable, $operatorType, $value);
    }
}
