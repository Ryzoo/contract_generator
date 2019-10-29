<?php


namespace App\Core\Models\Domain\Attributes;


use App\Core\Contracts\Domain\IAttribute;
use App\Core\Enums\AttributeType;
use App\Core\Models\Domain\Conditional\Conditional;
use Exception;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Exception\NotFoundException;

abstract class Attribute implements IAttribute  {
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
    /**
     * @var array
     */
    public $conditionals;
    /**
     * @var string
     */
    public $placeholder;

    public $value;
    public $defaultValue;

    protected function initialize(int $attributeType){
        $this->attributeType = $attributeType;
        $this->attributeName = AttributeType::getName($attributeType);
        $this->settings = [];
        $this->conditionals = [];
        $this->value = null;
        $this->id = 0;
        $this->name = "no_name";
        $this->placeholder = "";
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
            case AttributeType::TEXT:
                return new TextAttribute();
            case AttributeType::SELECT:
                return new SelectAttribute();
        }

        throw new NotFoundException("Attribute type number:{$attributeType} was not found");
    }

    public static function validate($value):bool {
        Validator::validate($value,[
            "id" => "required|integer",
            "attributeType" => "required|integer",
            "attributeName" => "required|string",
            "conditionals" => "nullable|array",
            "defaultValue" => "nullable|integer",
            "settings" => "required",
        ]);

        return true;
    }

    public static function getListFromString(string $value): array {
        $arrayOfAttributes = json_decode($value);
        $returnedArray = [];

        if(!is_array($arrayOfAttributes))
            throw new Exception(_('custom.array.attributes'));

        foreach ($arrayOfAttributes as $attribute){
            array_push($returnedArray, self::getFromString((array)$attribute));
        }

        return $returnedArray;
    }

    public static function getFromString(array $value):Attribute {
        Attribute::validate($value);
        $attribute = self::getAttributeByType($value["attributeType"]);

        $attribute->attributeType = $value["attributeType"];
        $attribute->attributeName = AttributeType::getName($value["attributeType"]);
        $attribute->settings = $value["settings"];
        $attribute->name = $value["attributeName"];
        $attribute->conditionals = isset($value["conditionals"] ) ? Conditional::getListFromString(json_encode($value["conditionals"])) : [];
        $attribute->id = intval($value["id"]);

        if(isset($value["defaultValue"]))
            $attribute->defaultValue = $value["defaultValue"];

        if(isset($value["value"]))
            $attribute->value = $value["value"];

        if(isset($value["placeholder"]))
            $attribute->placeholder = $value["placeholder"];

        return $attribute;
    }

    public function getValue(){
        return $this->value;
    }
}
