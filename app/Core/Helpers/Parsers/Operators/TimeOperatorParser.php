<?php

namespace App\Core\Helpers\Parsers\Operators;

use App\Core\Helpers\Parsers\OperatorType;
use Carbon\Carbon;

class TimeOperatorParser extends DefaultParser {

  static function parse($variable, $operatorType, $value)
  {
    if(!isset($value)) {
      return 'false';
    }

    switch ($operatorType) {
      case OperatorType::GREATER:
        return "new DateTime('2020-01-01 ${variable}') > new DateTime('2020-01-01 ${value}')";
      case OperatorType::GREATER_OR_EQUAL:
        return "new DateTime('2020-01-01 ${variable}') >= new DateTime('2020-01-01 ${value}')";
      case OperatorType::SMALLER:
        return "new DateTime('2020-01-01 ${variable}') < new DateTime('2020-01-01 ${value}')";
      case OperatorType::SMALLER_OR_EQUAL:
        return "new DateTime('2020-01-01 ${variable}') <= new DateTime('2020-01-01 ${value}')";
    }
    return DefaultParser::parse($variable, $operatorType, $value);
  }

}
