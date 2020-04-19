<?php


namespace App\Core\Traits;


use App\Core\Enums\AttributeType;
use App\Core\Enums\ElementType;
use App\Core\Helpers\Parsers\ModelObjectToTextParser;
use App\Core\Models\Database\Contract;
use App\Core\Models\Domain\FormElements\AttributeFormElement;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

trait ConditionalValidator {
  private Collection $conditionalList;
  protected Collection $formElements;
  public bool $isActive;

  public function validateConditions(int $conditionalType, Collection $formElements, Contract $contract): bool {
    if (!isset($this->conditionals)) {
      throw new \ErrorException('Conditional validator implemented in class without conditionals field');
    }

    $this->formElements = $formElements;

    $this->conditionalList = collect(collect($this->conditionals)
      ->where('conditionalType', $conditionalType)
      ->all());

    $self = $this;

    $this->isActive = $this->conditionalList
      ->every(static function ($element) use ($self) {
        return $self->isConditionalValidAndEqual(ModelObjectToTextParser::parse(json_decode($element->content, TRUE, 512, JSON_THROW_ON_ERROR)), TRUE);
      });

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
        return $textElements;
      })
      ->all();

    return eval('return ' . implode(' ', $contentWithVariables) . ';');
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

        if (!(bool)$attr->settings['isMultiUse'] && $attr->attributeType === AttributeType::ATTRIBUTE_GROUP) {
          $foundedAttribute = collect($attrValue)->where('id', (int) $value)->first();
        } else if ((bool)$attr->settings['isMultiUse'] && $attr->attributeType === AttributeType::ATTRIBUTE_GROUP) {
          $foundedAttribute = $attrValue[$index]->where('id', (int) $value)->first();
        } else if (!(bool)$attr->settings['isMultiUse']) {
          $foundedAttribute = $attrValue;
        } else {
          $foundedAttribute = $attrValue[$index];
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

    return $foundedAttribute->getValue();
  }
}
