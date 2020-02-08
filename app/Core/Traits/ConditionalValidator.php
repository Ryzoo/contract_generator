<?php


namespace App\Core\Traits;


use App\Core\Enums\ElementType;
use App\Core\Helpers\Parsers\ModelObjectToTextParser;
use App\Core\Models\Database\Contract;
use App\Core\Models\Domain\FormElements\AttributeFormElement;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

trait ConditionalValidator {

  /** @var \Illuminate\Support\Collection */
  private $conditionalList;

  /** @var \Illuminate\Support\Collection */
  private $formElements;

  /**
   * @var bool
   */
  public $isActive;

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
        return $self->isConditionalValidAndEqual(ModelObjectToTextParser::parse(json_decode($element->content)), TRUE);
      });

    return $this->isActive;
  }

  private function isConditionalValidAndEqual($content, bool $equalValue): bool {
    if (strlen($content) <= 0) {
      return $equalValue;
    }

    return $this->parseConditionalStringToBool($content) === $equalValue;
  }

  private function parseConditionalStringToBool($content) {
    $self = $this;

    $contentWithVariables = collect(explode(' ', $content))
      ->map(static function ($textElements) use ($self, $content) {
        preg_match('/{(\d+)}/', $textElements, $matches);
        if (isset($matches[1])) {
          $var = $self->getVariableValue((int) $matches[1]);
          $search = $matches[1];
          return str_replace("{{$search}}", $var ?? 'null', $textElements);
        }
        return $textElements;
      })
      ->all();

    return eval('return ' . implode(' ', $contentWithVariables) . ';');
  }

  private function getVariableValue(int $varId) {
    $allAttributes = $this->formElements
      ->where('elementType', ElementType::ATTRIBUTE)
      ->map(static function (AttributeFormElement $e) {
        return $e->attribute;
      })
      ->all();

    $foundedAttribute = collect($allAttributes)
      ->where('id', $varId)
      ->first();

    if (!isset($foundedAttribute)) {
      throw new \ErrorException("Var: {$varId} not found");
    }

    return $foundedAttribute->getValue();
  }
}
