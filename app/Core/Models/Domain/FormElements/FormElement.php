<?php


namespace App\Core\Models\Domain\FormElements;


use App\Core\Contracts\Domain\IFormElement;
use App\Core\Enums\ElementType;
use Illuminate\Support\Facades\Validator;
use App\Core\Models\Domain\Attributes\Attribute;
use App\Core\Models\Domain\Conditional\Conditional;
use Illuminate\Support\Collection;
use Whoops\Exception\ErrorException;

abstract class FormElement implements IFormElement {

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

    /** @var bool */
    public $isValid;

    /** @var bool */
    public $isActive;

    public function __construct(int $parentBlockId) {
        $this->parentBlockId = $parentBlockId;
    }

    public static function validate($value): bool {
        Validator::validate($value, [
            "parentBlockId" => "required|integer",
            "elementType" => "required|integer",
            "conditionals" => "nullable|array",
            "isValid" => "nullable",
            "isActive" => "nullable",
        ]);

        return TRUE;
    }

    protected function initialize(int $elementType) {
        $this->elementType = $elementType;
        $this->elementName = ElementType::getName($elementType);
        $this->conditionals = collect();
        $this->isValid = TRUE;
        $this->isActive = TRUE;
    }

    public static function getFormElementByType(int $formElementType, array $value): FormElement {
        if(!isset($value["parentBlockId"]))
            throw new ErrorException("Form element can be decoded without parentBlockId field");
        $parentBlockId = $value["parentBlockId"];

        switch ($formElementType) {
            case ElementType::ATTRIBUTE:
                if(!isset($value["attribute"]))
                    throw new ErrorException("Attribute form element can be decoded without attribute field");
                $attribute = Attribute::getFromString((array)$value["attribute"]);
                return new AttributeFormElement($parentBlockId, $attribute);
            case ElementType::PAGE_BRAKE:
                return new PageDividerFormElement($parentBlockId);
        }

        throw new ErrorException("Form element {$formElementType} was not found");
    }

    public static function getListFromString(string $value): Collection {
        $arrayOfElements = json_decode($value);
        $returnedArray = collect();

        if (!is_array($arrayOfElements)) {
            throw new ErrorException(_('custom.array.attributes'), 500);
        }

        /** @var \App\Models\Domain\FormElements\FormElement $formElement */
        foreach ($arrayOfElements as $formElement) {
            $returnedArray->push(self::getFromString((array) $formElement));
        }

        return $returnedArray;
    }

    public static function getFromString(array $value): FormElement {
        FormElement::validate($value);
        $element = self::getFormElementByType((int)$value["elementType"], $value);

        $element->parentBlockId = $value["parentBlockId"];
        $element->elementType = $value["elementType"];
        $element->elementName = ElementType::getName($value["elementType"]);
        $element->conditionals = collect(Conditional::getListFromString(json_encode($value["conditionals"])));
        $element->isActive = $value["isActive"] == "true";
        $element->isValid = $value["isValid"] == "true";

        return $element;
    }

}
