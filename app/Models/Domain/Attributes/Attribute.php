<?php


namespace App\Models\Domain\Attributes;


use App\Contracts\Domain\IAttribute;
use App\Enums\AttributeType;

abstract class Attribute implements IAttribute {
    /**
     * @var int
     */
    public $attributeType;
    /**
     * @var string
     */
    public $attributeName;

    /**
     * @var array
     */
    public $settings;

    public $value;
    public $defaultValue;

    protected function initialize(int $attributeType){
        $this->attributeType = $attributeType;
        $this->attributeName = AttributeType::getName($attributeType);
        $this->settings = [];
        $this->value = null;
        $this->defaultValue = null;
        $this->buildObject();
    }

    protected function buildObject(){
        $this->buildSettings();
    }

    protected abstract function buildSettings();
}