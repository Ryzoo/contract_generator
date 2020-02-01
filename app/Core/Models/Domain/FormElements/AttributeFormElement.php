<?php


namespace App\Core\Models\Domain\FormElements;



use App\Core\Enums\ElementType;
use App\Core\Models\Domain\Attributes\Attribute;

class AttributeFormElement extends FormElement {
    /**
     * @var Attribute
     */
    public $attribute;

    public function __construct(int $parentBlockId, Attribute $attribute) {
        parent::__construct($parentBlockId);
        parent::initialize(ElementType::ATTRIBUTE);
        $this->attribute = $attribute;
        $this->attribute->value = $this->attribute->value ?? $this->attribute->defaultValue;
    }
}
