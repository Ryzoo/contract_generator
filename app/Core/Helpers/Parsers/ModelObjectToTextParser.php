<?php

namespace App\Core\Helpers\Parsers;

use App\Core\Helpers\Parsers\Operators\AggregateOperatorParser;
use App\Core\Helpers\Parsers\Operators\BoolInputOperatorParser;
use App\Core\Helpers\Parsers\Operators\BoolOperatorParser;
use App\Core\Helpers\Parsers\Operators\DateOperatorParser;
use App\Core\Helpers\Parsers\Operators\MultiSelectOperatorParser;
use App\Core\Helpers\Parsers\Operators\NumberOperatorParser;
use App\Core\Helpers\Parsers\Operators\SelectOperatorParser;
use App\Core\Helpers\Parsers\Operators\TextOperatorParser;
use App\Core\Helpers\Parsers\Operators\TimeOperatorParser;
use Carbon\Carbon;
use Illuminate\Support\Collection;

class ModelObjectToTextParser {

  public static function parse($modelObject): string {
    return self::parseGroup($modelObject['operator'], $modelObject['children']);
  }

  public static function parseRule($id, $operatorType, $value, $ruleType): string {
    $variable = "{{$id}}";

    switch ($ruleType) {
      case RuleTypes::TEXT:
        return TextOperatorParser::parse("'$variable'", $operatorType, $value ? "'$value'" : "''");
      case RuleTypes::DATE:
        return DateOperatorParser::parse("'$variable'", $operatorType, $value ? new Carbon($value) : null);
      case RuleTypes::TIME:
        return TimeOperatorParser::parse($variable, $operatorType, $value ?: null);
      case RuleTypes::BOOL:
        return BoolOperatorParser::parse($variable, $operatorType, $value ?? false);
      case RuleTypes::NUMBER:
        return NumberOperatorParser::parse($variable, $operatorType, isset($value) ? (float) $value : -1);
      case RuleTypes::SELECT:
        return SelectOperatorParser::parse("'$variable'", $operatorType, $value ? "'$value'" : "''");
      case RuleTypes::MULTI_SELECT:
        return MultiSelectOperatorParser::parse("'$variable'", $operatorType, $value ? "'".implode('|,', $value)."'" : "''");
      case RuleTypes::AGGREGATE:
        return AggregateOperatorParser::parse($variable, $operatorType, isset($value) ? (float) $value : null);
      case RuleTypes::BOOL_INPUT:
        return BoolInputOperatorParser::parse($variable, $operatorType, $value ?: null);
    }

    return '';
  }

  public static function parseChildren(array $childrenArray): Collection {
    return collect($childrenArray)->map(static function ($child) {
      switch ($child['type']) {
        case 'rule':
          return ModelObjectToTextParser::parseRule($child['query']['id'], $child['query']['operator'], $child['query']['value'], $child['query']['ruleType']);
        case 'group':
          $var = ${ModelObjectToTextParser::parseGroup($child['query']['operator'], $child['query']['children'])};
          return "( $var )";
      }
      return '';
    });
  }

  public static function parseGroup($operator, $children): string {
    $parsedChildren = self::parseChildren($children ?? []);
    return implode($operator === 'All' ? ' && ' : ' || ', $parsedChildren->toArray());
  }
}
