<?php


namespace App\Models\Domain\Attributes;


use App\Contracts\Domain\IAttribute;
use App\Enums\AttributeType;
use App\Helpers\Response;
use App\Helpers\Validator;
use App\Services\Domain\AttributeService;
use Intervention\Image\Exception\NotFoundException;

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

    public $name;
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

    public static function getAttributeByType(int $attributeType):IAttribute {
        switch ($attributeType)
        {
            case AttributeType::NUMBER:
                return new NumberAttribute();
        }

        throw new NotFoundException("Attribute {$attributeType} was not found");
    }

    public static function validate($value):bool {
        Validator::validate($value,[
            "id" => "required|integer",
            "name" => "required|string",
            "defaultValue" => "nullable|string",
            "value" => "nullable|string",
            "settings" => "required|json",
        ]);

        return true;
    }

    public static function getListFromString(string $value): array {
        $arrayOfAttributes = json_decode($value);
        $returnedArray = [];

        if(!is_array($arrayOfAttributes))
            Response::error(_('custom.array.attributes'));

        foreach ($arrayOfAttributes as $attribute){
            array_push($returnedArray, self::getFromString($attribute));
        }

        return $returnedArray;
    }

    public static function getFromString($value):IAttribute {
        Attribute::validate($value);
        $attribute = self::getAttributeByType($value["id"]);

        $attribute->attributeType = $value["id"];
        $attribute->attributeName = AttributeType::getName($value["id"]);
        $attribute->settings = $value["settings"];
        $attribute->name = $value["name"];
        $attribute->defaultValue = $value["defaultValue"];

        return $attribute;
    }
}
