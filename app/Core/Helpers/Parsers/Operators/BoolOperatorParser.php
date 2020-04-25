<?php

namespace App\Core\Helpers\Parsers\Operators;

use App\Core\Helpers\Parsers\OperatorType;
use phpDocumentor\Reflection\Types\Boolean;

class BoolOperatorParser extends DefaultParser {

  public static function parse($variable, $operatorType, $value):string
  {
    $value = (bool) $value;

    switch ($operatorType) {
      case OperatorType::EQUAL:
        return "(bool) ${variable} === (bool) ${value}";
      case OperatorType::N_EQUAL:
        return "(bool) ${variable} !== (bool) ${value}";
    }
    return DefaultParser::parse($variable, $operatorType, $value);
  }

}
