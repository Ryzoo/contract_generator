<?php


namespace App\Models\Domain\FormElements;



use App\Enums\ElementType;
use App\Models\Domain\Attributes\Attribute;

class AttributeFormElement extends FormElement {
    /**
     * @var Attribute
     */
    public $attribute;

    public function __construct(int $parentBlockId, Attribute $attribute) {
        parent::__construct($parentBlockId);
        parent::initialize(ElementType::ATTRIBUTE);
        $this->attribute = $attribute;
    }
}
