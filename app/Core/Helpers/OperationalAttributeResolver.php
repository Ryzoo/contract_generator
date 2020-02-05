<?php

namespace App\Core\Helpers;

use App\Core\Contracts\IAggregableByAttributeAggregator;
use App\Core\Enums\ElementType;
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

  protected function getAttributeValueById(int $id): string {
    $attribute = $this->attributes
      ->where('id', $id)
      ->first();

    $value = isset($attribute) ? $attribute->getOperationalValue($this->type) : 0;

    return $value;
  }

}
