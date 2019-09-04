<?php


namespace App\Models\Domain;


use App\Contracts\Domain\IAttribute;

class FormInput {
    /**
     * @var IAttribute
     */
    public $attribute;

    public function __construct(IAttribute $attribute) {
        $this->attribute = $attribute;
    }
}
