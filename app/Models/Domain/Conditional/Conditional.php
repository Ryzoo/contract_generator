<?php


namespace App\Models\Domain\Conditional;


use App\Contracts\Domain\IConditional;
use App\Enums\ConditionalType;

abstract class Conditional implements IConditional {
    /**
     * @var int
     */
    public $conditionalType;
    /**
     * @var string
     */
    public $conditionalName;

    protected function initialize(int $conditionalType){
        $this->conditionalType = $conditionalType;
        $this->conditionalName = ConditionalType::getName($conditionalType);
    }

    public static function getListFromString(string $value): array {

    }
}
