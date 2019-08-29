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
    /**
     * @var int
     */
    public $id;
    /**
     * @var string
     */
    public $name;

    public $value;
    public $defaultValue;

    protected function initialize(int $attributeType){
        $this->attributeType = $attributeType;
        $this->attributeName = AttributeType::getName($attributeType);
        $this->settings = [];
        $this->value = null;
        $this->id = 0;
        $this->name = "no_name";
        $this->defaultValue = null;
        $this->buildObject();
    }

    protected function buildObject(){
        $this->buildSettings();
    }

    protected abstract function buildSettings();

    public static function getAttributeByType(int $attributeType):Attribute {
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
            "type" => "required|integer",
            "name" => "required|string",
            "defaultValue" => "nullable|integer",
            "value" => "nullable|integer",
            "settings" => "required",
        ]);

        return true;
    }

    public static function getListFromString(string $value): array {
        $arrayOfAttributes = json_decode($value);
        $returnedArray = [];

        if(!is_array($arrayOfAttributes))
            Response::error(_('custom.array.attributes'));

        foreach ($arrayOfAttributes as $attribute){
            array_push($returnedArray, self::getFromString((array)$attribute));
        }

        return $returnedArray;
    }

    public static function getFromString(array $value):Attribute {
        Attribute::validate($value);
        $attribute = self::getAttributeByType($value["type"]);

        $attribute->attributeType = $value["type"];
        $attribute->attributeName = AttributeType::getName($value["type"]);
        $attribute->settings = $value["settings"];
        $attribute->name = $value["name"];
        $attribute->id = intval($value["id"]);
        $attribute->defaultValue = $value["defaultValue"];

        return $attribute;
    }
}
