<?php


namespace App\Core\Models\Domain\FormElements;


use App\Core\Enums\ElementType;
use App\Core\Models\Domain\Attributes\Attribute;
use Illuminate\Support\Collection;

class AttributeFormElement extends FormElement {
  public function __construct(int $parentBlockId, Attribute $attribute) {
    parent::__construct($parentBlockId);
    $this->initialize(ElementType::ATTRIBUTE);
    $this->attribute = $attribute;
    $this->attribute->value = $this->attribute->value ?? $this->attribute->defaultValue;
  }

  public function resolveAttributesInSettings(Collection $formElements):void {
    $this->attribute->resolveAttributesInSettings($formElements);
  }
}
