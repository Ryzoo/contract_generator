<?php

namespace App\Core\Helpers\Parsers\Operators;

use App\Core\Helpers\Parsers\OperatorType;

class BoolInputOperatorParser extends DefaultParser
{
    public static function parse($variable, $operatorType, $value):string
    {
      $value = isset($value) ? (int)$value->bool : false;

      switch ($operatorType) {
        case OperatorType::EQUAL:
          return "(bool) ${variable} === (bool) ${value}";
        case OperatorType::N_EQUAL:
          return "(bool) ${variable} !== (bool) ${value}";
      }
      return DefaultParser::parse($variable, $operatorType, $value);
    }
}
