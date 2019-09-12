<?php


namespace App\Models\Domain\Conditional;


use App\Contracts\Domain\IConditional;
use App\Enums\ConditionalType;
use App\Helpers\Response;
use App\Helpers\Validator;
use Illuminate\Support\Collection;
use Whoops\Exception\ErrorException;

abstract class Conditional implements IConditional {
    /**
     * @var int
     */
    public $conditionalType;
    /**
     * @var string
     */
    public $conditionalName;
    /**
     * @var array
     */
    public $content;

    protected function initialize(int $conditionalType){
        $this->conditionalType = $conditionalType;
        $this->conditionalName = ConditionalType::getName($conditionalType);
        $this->content = [];
    }

    public static function getConditionalByType(int $conditionalType):Conditional {
        switch ($conditionalType)
        {
            case ConditionalType::SHOW_ON:
                return new ShowOn();
        }

        throw new ErrorException("Conditional {$conditionalType} was not found");
    }

    public static function validate($value):bool {
        Validator::validate($value,[
            "conditionalType" => "required|integer",
            "content" => "required",
        ]);

        return true;
    }

    public static function getListFromString(string $value): array {
        $arrayOfConditional = json_decode($value);
        $returnedArray = [];

        if(!is_array($arrayOfConditional))
            Response::error(_('custom.array.attributes'));

        foreach ($arrayOfConditional as $conditional){
            array_push($returnedArray, self::getFromString((array)$conditional));
        }

        return $returnedArray;
    }

    public static function getFromString(array $value):Conditional {
        Conditional::validate($value);
        $conditional = self::getConditionalByType($value["conditionalType"]);

        $conditional->conditionalType = $value["conditionalType"];
        $conditional->conditionalName = ConditionalType::getName($value["conditionalType"]);
        $conditional->content = $value["content"];

        return $conditional;
    }

    public function getUsedVariable(): Collection{
        $usedVariables = collect();

        foreach ($this->content as $element){
            preg_match_all('/{(\d)}/', $element, $output_array);

            if(isset($output_array[1] ) && is_array($output_array[1] ))
                foreach ($output_array[1] as $arrayElement)
                    $usedVariables->push($arrayElement);
        }

        return $usedVariables;
    }
}
