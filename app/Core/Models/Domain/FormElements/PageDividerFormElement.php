<?php


namespace App\Core\Models\Domain\FormElements;


use App\Core\Enums\ElementType;
use Illuminate\Support\Collection;

class PageDividerFormElement extends FormElement {

  public function __construct(int $parentBlockId, string $elementName) {
    parent::__construct($parentBlockId);
    $this->initialize(ElementType::PAGE_BRAKE);
    $this->elementName = $elementName;
  }

  public function resolveAttributesInSettings(Collection $formElements) {
    // TODO: Implement resolveAttributesInSettings() method.
  }
}
