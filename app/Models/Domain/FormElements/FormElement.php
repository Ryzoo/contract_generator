<?php


namespace App\Models\Domain\FormElements;


use App\Contracts\Domain\IFormElement;
use App\Enums\ElementType;

abstract class FormElement implements IFormElement{
    /**
     * @var int
     */
    public $parentBlockId;
    /**
     * @var int
     */
    public $elementType;
    /**
     * @var string
     */
    public $elementName;
    /**
     * @var \Illuminate\Support\Collection
     */
    public $conditionals;

    public function __construct(int $parentBlockId) {
        $this->parentBlockId = $parentBlockId;
    }

    protected function initialize(int $elementType){
        $this->elementType = $elementType;
        $this->elementName = ElementType::getName($elementType);
        $this->parentBlockId = 0;
        $this->conditionals = collect();
    }
}
