<?php


namespace App\Core\Models\Domain\Attributes;


use App\Core\Contracts\IAttribute;
use App\Core\Enums\AttributeType;
use App\Core\Models\Domain\Conditional\Conditional;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Exception\NotFoundException;
use RuntimeException;

abstract class Attribute implements IAttribute
{
    public int $id;
    public int $attributeType;
    public ?string $attributeName;
    public array $settings;
    public array $conditionals;
    public array $content;
    public string $placeholder;
    public string $labelAfter;
    public $value;
    public $defaultValue;
    public string $description;
    public string $additionalInformation;
    public bool $toAnonymize;
    public bool $isActive;

    abstract protected function buildSettings(): void;

    public function resolveAttributesInSettings(Collection $formElements): void
    {
    }

    protected function initialize(int $attributeType): void
    {
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
        $this->labelAfter = '';
        $this->isActive = false;
        $this->buildObject();
    }

    protected function buildObject(): void
    {
        $this->buildSettings();
    }

    protected function parseContent(): void
    {
        if (!isset($this->settings) || $this->settings === [])
            $this->buildSettings();

        $this->content = (isset($this->content) && is_array($this->content)) ? self::getListFromString(json_encode($this->content, JSON_THROW_ON_ERROR, 512)) : [];
    }

    public static function getAttributeByType(int $attributeType): Attribute
    {
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
            case AttributeType::CURRENCY:
                return new CurrencyAttribute();
        }

        throw new NotFoundException("Attribute type number:{$attributeType} was not found");
    }

    public static function validate($value): bool
    {
        Validator::validate($value, [
            'id' => 'sometimes|required|integer',
            'attributeType' => 'required|integer',
            'attributeName' => 'sometimes|string',
            'conditionals' => 'sometimes|array',
        ]);

        return TRUE;
    }

    public static function getListFromString(string $value): array
    {
        $arrayOfAttributes = json_decode($value, TRUE, 512, JSON_THROW_ON_ERROR);
        $returnedArray = [];

        if (!is_array($arrayOfAttributes)) {
            throw new RuntimeException(_('custom.array.attributes'));
        }

        foreach ($arrayOfAttributes as $attribute) {
            $returnedArray[] = self::getFromString((array)$attribute);
        }

        return $returnedArray;
    }

    public static function getFromString(array $value): Attribute
    {
        self::validate($value);
        $attribute = self::getAttributeByType($value['attributeType']);

        $attribute->attributeType = (int)$value['attributeType'];
        $attribute->attributeName = $value['attributeName'] ?? (string)$value['attributeType'];
        $attribute->settings = $value['settings'];
        $attribute->conditionals = isset($value['conditionals']) ? Conditional::getListFromString(json_encode($value['conditionals'], JSON_THROW_ON_ERROR, 512)) : [];
        $attribute->id = (int)($value['id'] ?? -1);
        $attribute->toAnonymize = $value['toAnonymize'] ?? FALSE;
        $attribute->description = $value['description'] ?? '';
        $attribute->additionalInformation = $value['additionalInformation'] ?? '';
        $attribute->labelAfter = $value['labelAfter'] ?? '';
        $attribute->defaultValue = $value['defaultValue'] ?? NULL;
        $attribute->value = $value['value'] ?? NULL;
        $attribute->placeholder = $value['placeholder'] ?? '';
        $attribute->content = (array)($value['content'] ?? []);
        $attribute->isActive = (bool)($value['isActive'] ?? false);

        $attribute->parseContent();

        return $attribute;
    }

    public function getValue()
    {
        return $this->valueParser($this->value);
    }

    // return value for other action like condition check
    public function getRavValue()
    {
        return $this->value;
    }

    // allow to change default value when processed
    public function getDefaultValue()
    {
        return $this->defaultValue;
    }

    public function valueParser($value)
    {
        return $value;
    }
}
