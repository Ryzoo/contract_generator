<?php


namespace App\Core\Models\Domain\FormElements;


use App\Core\Enums\ElementType;
use Illuminate\Support\Collection;

class PageDividerFormElement extends FormElement {

  public function __construct(int $parentBlockId) {
    parent::__construct($parentBlockId);
    $this->initialize(ElementType::PAGE_BRAKE);
  }

  public function resolveAttributesInSettings(Collection $formElements) {
    // TODO: Implement resolveAttributesInSettings() method.
  }
}
