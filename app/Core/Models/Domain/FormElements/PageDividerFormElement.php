<?php


namespace App\Core\Models\Domain\FormElements;


use App\Core\Enums\ElementType;

class PageDividerFormElement extends FormElement {

    public function __construct(int $parentBlockId) {
        parent::__construct($parentBlockId);
        parent::initialize(ElementType::PAGE_BRAKE);
    }
}
