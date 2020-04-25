<?php

namespace App\Core\Helpers\Parsers\Operators;

use App\Core\Helpers\Parsers\OperatorType;
use Carbon\Carbon;

class DateOperatorParser extends DefaultParser {

  public static function parse($variable, $operatorType, $value):string
  {
    if(!isset($value) || !($value instanceof Carbon)) {
      return 'false';
    }

    switch ($operatorType) {
      case OperatorType::GREATER:
        return "new DateTime(${variable}) > new DateTime('${value}')";
      case OperatorType::GREATER_OR_EQUAL:
        return "new DateTime(${variable}) >= new DateTime('${value}')";
      case OperatorType::SMALLER:
        return "new DateTime(${variable}) < new DateTime('${value}')";
      case OperatorType::SMALLER_OR_EQUAL:
        return "new DateTime(${variable}) <= new DateTime('${value}')";
    }
    return DefaultParser::parse($variable, $operatorType, $value);
  }

}
