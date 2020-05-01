<?php


namespace App\Core\Models\Domain\FormElements;


use App\Core\Contracts\IFormElement;
use App\Core\Enums\ElementType;
use Illuminate\Support\Facades\Validator;
use App\Core\Models\Domain\Attributes\Attribute;
use App\Core\Models\Domain\Conditional\Conditional;
use Illuminate\Support\Collection;
use Whoops\Exception\ErrorException;

abstract class FormElement implements IFormElement {
  public int $parentBlockId;
  public int $elementType;
  public ?string $elementName;
  public array $conditionals;
  public bool $isValid;
  public bool $isActive;
  public ?Attribute $attribute;

  public function __construct(int $parentBlockId) {
    $this->parentBlockId = $parentBlockId;
  }

  public static function validate($value): bool {
    Validator::validate($value, [
      'parentBlockId' => 'required|integer',
      'elementType' => 'required|integer',
      'conditionals' => 'nullable|array',
      'isValid' => 'nullable',
      'isActive' => 'nullable',
    ]);

    return TRUE;
  }

  abstract public function resolveAttributesInSettings(Collection $formElements):void;

  protected function initialize(int $elementType): void {
    $this->elementType = $elementType;
    $this->elementName = ElementType::getName($elementType);
    $this->conditionals = [];
    $this->isValid = TRUE;
    $this->isActive = TRUE;
  }

  public static function getFormElementByType(int $formElementType, array $value): FormElement {
    if (!isset($value['parentBlockId'])) {
      throw new ErrorException('Form element can be decoded without parentBlockId field');
    }
    $parentBlockId = $value['parentBlockId'];

    switch ($formElementType) {
      case ElementType::ATTRIBUTE:
        if (!isset($value['attribute'])) {
          throw new ErrorException('Attribute form element can be decoded without attribute field');
        }
        $attribute = Attribute::getFromString((array) $value['attribute']);
        return new AttributeFormElement($parentBlockId, $attribute);
      case ElementType::PAGE_BRAKE:
        return new PageDividerFormElement($parentBlockId, $value['elementName']);
    }

    throw new ErrorException("Form element {$formElementType} was not found");
  }

  public static function getListFromString(string $value): Collection {
    $arrayOfElements = json_decode($value, TRUE, 512, JSON_THROW_ON_ERROR);
    $returnedArray = collect();

    if (!is_array($arrayOfElements)) {
      throw new ErrorException(_('custom.array.attributes'), 500);
    }

    /** @var FormElement $formElement */
    foreach ($arrayOfElements as $formElement) {
      $returnedArray->push(self::getFromString((array) $formElement));
    }

    return $returnedArray;
  }

  public static function getFromString(array $value): FormElement {
    self::validate($value);
    $element = self::getFormElementByType((int) $value['elementType'], $value);

    $element->parentBlockId = $value['parentBlockId'];
    $element->elementType = $value['elementType'];
    $element->elementName = $value['elementName'];
    $element->conditionals = collect(Conditional::getListFromString(json_encode($value['conditionals'], JSON_THROW_ON_ERROR, 512)))->toArray();
    $element->isActive = (bool) $value['isActive'];
    $element->isValid = (bool) $value['isValid'];

    if(isset($element->attribute)){
      $element->attribute->isActive = $element->isActive;
    }

    return $element;
  }

}
