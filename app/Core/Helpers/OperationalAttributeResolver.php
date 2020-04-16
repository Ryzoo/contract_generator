<?php

namespace App\Core\Helpers;

use App\Core\Contracts\IAggregableByAttributeAggregator;
use App\Core\Enums\ElementType;
use App\Core\Models\Domain\Attributes\Attribute;
use Illuminate\Support\Collection;

class OperationalAttributeResolver extends AttributeResolver {
  /**
   * @var Collection
   */
  private $attributes;

  /**
   * @var string
   */
  private $type;

  public function __construct(Collection $formElements, string $type) {
    parent::__construct($formElements);
    $this->attributes = $this->formElements
      ->filter(static function ($e) {
        return $e->attribute instanceof IAggregableByAttributeAggregator;
      })
      ->where('elementType', ElementType::ATTRIBUTE)
      ->map(static function ($e) {
        return $e->attribute;
      });
    $this->type = $type;
  }

  public function resolveText(string $text, bool $resolveGroup = false) {
    preg_match_all('/{(\d+)}/', $text, $attributeIdList);

    foreach ($attributeIdList[1] as $id) {
      $value = $this->getAttributeValueById((int) $id);
        $text = str_replace([
          '{' . $id . '}',
        ], [
          $this->escapeValue($value),
        ], $text);
    }

    return $text;
  }

  protected function getAttributeValueById(int $id): string {
    $attribute = $this->attributes
      ->where('id', $id)
      ->first();

    $value = isset($attribute) ? $attribute->getOperationalValue($this->type) : 0;

    return $value;
  }

}
