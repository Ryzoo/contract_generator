<?php

namespace App\Core\Helpers\Parsers\Operators;

use App\Core\Helpers\Parsers\OperatorType;

class TextOperatorParser extends DefaultParser {

    public static function parse($variable, $operatorType, $value):string
    {
        switch ($operatorType) {
            case OperatorType::EMPTY:
                return "!$variable || $variable === 'null'";
            case OperatorType::N_EMPTY:
                return "!!$variable && $variable !== 'null'";
        }

        return DefaultParser::parse($variable, $operatorType, $value);
    }
}
