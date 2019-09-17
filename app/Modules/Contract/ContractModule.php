<?php


namespace App\Modules\Contract;

use App\Models\Domain\Contract;

abstract class ContractModule {
    public $name;

    /**
     * @var Contract
     */
    private $contract;

    /**
     * @var array
     */
    private $attributes;


    public function run(Contract $contract, int $partType, array $attributes = []){
        $this->contract = $contract;
        $this->attributes = $attributes;

        return true;
    }

    protected function getModuleSettings(?string $secondKey = null){
        $moduleSettings = isset(((array)$this->contract->settings["modules"])[$this->name]) ? ((array)$this->contract->settings["modules"])[$this->name] : null;

        if(!isset($moduleSettings) || !isset($secondKey))
            return $moduleSettings;
        else
            return isset(((array)$moduleSettings)[$secondKey]) ? ((array)$moduleSettings)[$secondKey] : null;
    }

    protected function getAttribute(string $attributeName){
        return isset(((array)$this->attributes)[$attributeName]) ? ((array)$this->attributes)[$attributeName] : null;
    }
}
