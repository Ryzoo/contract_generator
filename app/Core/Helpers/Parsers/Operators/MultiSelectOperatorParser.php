<?php

namespace App\Core\Helpers\Parsers\Operators;

use App\Core\Helpers\Parsers\OperatorType;

class MultiSelectOperatorParser extends DefaultParser
{
    static function parse($variable, $operatorType, $value)
    {
        switch ($operatorType) {
            case OperatorType::EQUAL:
                return "collect(explode(',',${variable})).every( x => collect(explode(',',${value})).contains(x))";
            case OperatorType::N_EQUAL:
                return "!collect(explode(',',${variable})).every( x => collect(explode(',',${value})).contains(x))";
        }
        return DefaultParser::parse($variable, $operatorType, $value);
    }
}
