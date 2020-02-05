<?php

namespace App\Core\Helpers\Parsers\Operators;

use App\Core\Helpers\Parsers\OperatorType;

class AggregateOperatorParser extends DefaultParser {

  static function parse($variable, $operatorType, $value) {
    if (!isset($variable, $value)) {
      return 'false';
    }

    switch ($operatorType) {
      case OperatorType::GREATER:
        return "(double) ${variable} > (double) ${value}";
      case OperatorType::GREATER_OR_EQUAL:
        return "(double) ${variable} >= (double) ${value}";
      case OperatorType::SMALLER:
        return "(double) ${variable} < (double) ${value}";
      case OperatorType::SMALLER_OR_EQUAL:
        return "(double) ${variable} <= (double) ${value}";
    }
    return DefaultParser::parse($variable, $operatorType, $value);
  }
}
