<?php


namespace App\Core\Traits;


use App\Core\Enums\AttributeType;
use App\Core\Enums\ElementType;
use App\Core\Helpers\Parsers\ModelObjectToTextParser;
use App\Core\Models\Database\Contract;
use App\Core\Models\Domain\Attributes\Attribute;
use App\Core\Models\Domain\FormElements\AttributeFormElement;
use Illuminate\Support\Collection;
use phpDocumentor\Reflection\Types\Static_;

trait ConditionalValidator {
  protected Collection $formElements;
  public bool $isActive;

  public function validateConditions(int $conditionalType, Collection $formElements, Contract $contract, int $index = 0): bool {
    if (!isset($this->conditionals)) {
      throw new \ErrorException('Conditional validator implemented in class without conditionals field');
    }

    $this->formElements = $formElements;

    $conditionalList = $this->conditionals ? collect($this->conditionals) : collect();
    $self = $this;

    if(isset($conditionalList[0]) && is_array($conditionalList[0])){
      $this->isActive = $conditionalList->every(static function($condition){
        $condition = collect($condition);
        return $condition->count() === 0;
      }) || $conditionalList
          ->filter(static function($condition){ return (bool)collect($condition)->count(); })
          ->first(static function($condition)use ($self, $index){
            $condition = collect($condition);
            return $condition->every(static function ($element) use ($self, $index) {
                return $self->isConditionalValidAndEqual(
                  ModelObjectToTextParser::parse(json_decode($element->content, TRUE, 512, JSON_THROW_ON_ERROR)),
                  TRUE, $index);
              });
          });
    }else{
      $this->isActive = $conditionalList
        ->every(static function ($element) use ($self, $index) {
          return $self->isConditionalValidAndEqual(ModelObjectToTextParser::parse(json_decode($element->content, TRUE, 512, JSON_THROW_ON_ERROR)),TRUE, $index);
        });
    }

    return $this->isActive;
  }

  protected function isConditionalValidAndEqual($content, bool $equalValue, int $index = 0): bool {
    if (strlen($content) <= 0) {
      return $equalValue;
    }

    return $this->parseConditionalStringToBool($content, $index) === $equalValue;
  }

  private function parseConditionalStringToBool($content, int $index = 0) {
    $self = $this;

    $contentWithVariables = collect(explode(' ', $content))
      ->map(static function ($textElements) use ($self, $index) {
        preg_match('/{(\d+)}/', $textElements, $matches);
        if (isset($matches[1])) {
          $var = $self->getVariableValue($matches[1], $index);
          $search = $matches[1];
          return str_replace("{{$search}}", $var ?? 'null', $textElements);
        }
        preg_match('/{(\d+:\d+)}/', $textElements, $matches);
        if (isset($matches[1])) {
          $var = $self->getVariableValue($matches[1], $index);
          $search = $matches[1];
          return str_replace("{{$search}}", $var ?? 'null', $textElements);
        }
        preg_match('/{(\d+:value)}/', $textElements, $matches);
        if (isset($matches[1])) {
          $var = $self->getVariableValue($matches[1], $index);
          $search = $matches[1];
          return str_replace("{{$search}}", $var ?? 'null', $textElements);
        }
        preg_match('/{(\d+:counter)}/', $textElements, $matches);
        if (isset($matches[1])) {
          $var = $self->getVariableValue($matches[1], $index);
          $search = $matches[1];
          return str_replace("{{$search}}", $var ?? 'null', $textElements);
        }
        preg_match('/{(\d+:number)}/', $textElements, $matches);
        if (isset($matches[1])) {
          $var = $self->getVariableValue($matches[1], $index);
          $search = $matches[1];
          return str_replace("{{$search}}", $var ?? 'null', $textElements);
        }
        return $textElements;
      })
      ->all();

    $fullEvalText = 'return ' . implode(' ', $contentWithVariables) . ';';

    return eval($fullEvalText);
  }

  private function getVariableValue($varId, int $index = 0) {
    $allAttributes = $this->formElements
      ->where('elementType', ElementType::ATTRIBUTE)
      ->map(static function (AttributeFormElement $e) {
        return $e->attribute;
      })
      ->all();

    if (str_contains($varId, ':')) {
      [$id, $value] = explode(':', $varId);
      $attr = collect($allAttributes)->where('id', (int) $id)->first();

      if (isset($attr)) {
        $attrValue = $attr->value;

        if($value === 'counter'){
          return $attr->isActive ? count($attrValue) : 0;
        }

        if($value === 'number'){
          return $attr->getRavValue()['number'];
        }

        if (!(bool)$attr->settings['isMultiUse'] && $attr->attributeType === AttributeType::ATTRIBUTE_GROUP) {
          $foundedAttribute = collect($attrValue)->where('id', (int) $value)->first();
        } else if ((bool)$attr->settings['isMultiUse'] && $attr->attributeType === AttributeType::ATTRIBUTE_GROUP) {
          $foundedAttribute = collect($attrValue[$index])->where('id', (int) $value)->first();
        } else if (!(bool)$attr->settings['isMultiUse']) {
          $foundedAttribute = $attrValue;
        } else {
          $foundedAttribute = $attrValue[$index];
        }

        if(isset($foundedAttribute) && is_array($foundedAttribute)) {
          $foundedAttribute = Attribute::getFromString($foundedAttribute);
        }
      }
    } else {
      $foundedAttribute = collect($allAttributes)
        ->where('id', $varId)
        ->first();
    }

    if (!isset($foundedAttribute)) {
      throw new \ErrorException("Var: {$varId} not found");
    }


    return $foundedAttribute->getRavValue();
  }
}
