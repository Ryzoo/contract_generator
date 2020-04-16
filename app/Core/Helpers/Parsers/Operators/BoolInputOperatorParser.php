<?php

namespace App\Core\Helpers\Parsers\Operators;

use App\Core\Helpers\Parsers\OperatorType;

class BoolInputOperatorParser extends DefaultParser
{
    static function parse($variable, $operatorType, $value)
    {
      $value = isset($value) ? (bool)$value->bool : false;

      switch ($operatorType) {
        case OperatorType::EQUAL:
          return "(bool) ${variable} === (bool) ${value}";
        case OperatorType::N_EQUAL:
          return "(bool) ${variable} !== (bool) ${value}";
      }
      return DefaultParser::parse($variable, $operatorType, $value);
    }
}
