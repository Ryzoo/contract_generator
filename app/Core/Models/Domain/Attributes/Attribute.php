<?php


namespace App\Core\Models\Domain\Attributes;


use App\Core\Contracts\IAttribute;
use App\Core\Enums\AttributeType;
use App\Core\Enums\MultiUseRenderType;
use App\Core\Models\Domain\Conditional\Conditional;
use Exception;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Exception\NotFoundException;

abstract class Attribute implements IAttribute {

  /**
   * @var int
   */
  public $id;

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

  /**
   * @var array
   */
  public $conditionals;

  /**
   * @var array
   */
  public $content;

  /**
   * @var string
   */
  public $placeholder;

  public $value;

  public $defaultValue;

  /**
   * @var string
   */
  public $description;

  /**
   * @var string
   */
  public $additionalInformation;

  /**
   * @var bool
   */
  public $toAnonymize;

  abstract protected function buildSettings();

  public function resolveAttributesInSettings(Collection $formElements): void {
  }

  protected function initialize(int $attributeType) {
    $this->attributeType = $attributeType;
    $this->attributeName = AttributeType::getName($attributeType);
    $this->settings = [];
    $this->conditionals = [];
    $this->value = NULL;
    $this->id = 0;
    $this->toAnonymize = FALSE;
    $this->placeholder = '';
    $this->defaultValue = NULL;
    $this->description = '';
    $this->additionalInformation = '';
    $this->buildObject();
  }

  protected function buildObject() {
    $this->buildSettings();
  }

  protected function parseContent() {
    $this->content = (isset($this->content) && is_array($this->content)) ? self::getListFromString(json_encode($this->content, JSON_THROW_ON_ERROR, 512)) : [];
  }

  public static function getAttributeByType(int $attributeType): Attribute {
    switch ($attributeType) {
      case AttributeType::NUMBER:
        return new NumberAttribute();
      case AttributeType::TEXT:
        return new TextAttribute();
      case AttributeType::SELECT:
        return new SelectAttribute();
      case AttributeType::ATTRIBUTE_GROUP:
        return new RepeatGroupAttribute();
      case AttributeType::DATE:
        return new DateAttribute();
      case AttributeType::TIME:
        return new TimeAttribute();
      case AttributeType::BOOL:
        return new BoolAttribute();
      case AttributeType::AGGREGATE:
        return new AggregateAttribute();
      case AttributeType::BOOL_INPUT:
        return new BoolInputAttribute();
    }

    throw new NotFoundException("Attribute type number:{$attributeType} was not found");
  }

  public static function validate($value): bool {
    Validator::validate($value, [
      'id' => 'sometimes|required|integer',
      'attributeType' => 'required|integer',
      'attributeName' => 'required|string',
      'conditionals' => 'sometimes|array',
      'settings' => 'sometimes|required',
    ]);

    return TRUE;
  }

  public static function getListFromString(string $value): array {
    $arrayOfAttributes = json_decode($value, TRUE, 512, JSON_THROW_ON_ERROR);
    $returnedArray = [];

    if (!is_array($arrayOfAttributes)) {
      throw new Exception(_('custom.array.attributes'));
    }

    foreach ($arrayOfAttributes as $attribute) {
      $returnedArray[] = self::getFromString((array) $attribute);
    }

    return $returnedArray;
  }

  public static function getFromString(array $value): Attribute {
    self::validate($value);
    $attribute = self::getAttributeByType($value['attributeType']);

    $attribute->attributeType = (int) $value['attributeType'];
    $attribute->attributeName = $value['attributeName'];
    $attribute->settings = $value['settings'];
    $attribute->conditionals = isset($value['conditionals']) ? Conditional::getListFromString(json_encode($value['conditionals'], JSON_THROW_ON_ERROR, 512)) : [];
    $attribute->id = isset($value['id']) ? (int) $value['id'] : -1;
    $attribute->toAnonymize = $value['toAnonymize'] ?? FALSE;
    $attribute->description = $value['description'] ?? '';
    $attribute->additionalInformation = $value['additionalInformation'] ?? "";
    $attribute->defaultValue = $value['defaultValue'] ?? NULL;
    $attribute->value = $value['value'] ?? NULL;
    $attribute->placeholder = $value['placeholder'] ?? NULL;
    $attribute->content = (array) ($value['content'] ?? []);

    $attribute->parseContent();

    return $attribute;
  }

  public function getValue() {
    return $this->valueParser($this->value);
  }

  public function valueParser($value) {
    return $value;
  }
}
