<?php

namespace App\Core\Helpers\Parsers;

use App\Core\Helpers\Parsers\Operators\MultiSelectOperatorParser;
use App\Core\Helpers\Parsers\Operators\NumberOperatorParser;
use App\Core\Helpers\Parsers\Operators\SelectOperatorParser;
use App\Core\Helpers\Parsers\Operators\TextOperatorParser;

class ModelObjectToTextParser
{
    static function parse($modelObject)
    {
        return ModelObjectToTextParser::parseGroup($modelObject->operator, $modelObject->children);
    }

    static function parseRule($id, $operatorType, $value, $ruleType)
    {
        $variable = "{{$id}}";

        switch ($ruleType) {
            case RuleTypes::TEXT:
                return TextOperatorParser::parse("'$variable'", $operatorType, $value ? "'$value'" : "''");
            case RuleTypes::NUMBER:
                return NumberOperatorParser::parse($variable, $operatorType, $value ? intval($value) : -1);
            case RuleTypes::SELECT:
                return SelectOperatorParser::parse("'$variable'", $operatorType, $value ? "'$value'" : "''");
            case RuleTypes::MULTI_SELECT:
                return MultiSelectOperatorParser::parse("'$variable'", $operatorType, $value ? "'$value'" : "''");
        }

        return '';
    }

    static function parseChildren(array $childrenArray)
    {
        return collect($childrenArray)->map(function ($child){
            switch ($child->type) {
                case 'rule':
                    return ModelObjectToTextParser::parseRule($child->query->id, $child->query->operator, $child->query->value, $child->query->ruleType);
                case 'group':
                    $var = ${ModelObjectToTextParser::parseGroup($child->query->operator, $child->query->children)};
                    return "( $var )";
            }
            return '';
        });
    }

    static function parseGroup($operator, $children)
    {
        $parsedChildren = ModelObjectToTextParser::parseChildren($children ?? []);
        return implode( $parsedChildren->toArray(), $operator === 'All' ? ' && ' : ' || ');
    }
}
