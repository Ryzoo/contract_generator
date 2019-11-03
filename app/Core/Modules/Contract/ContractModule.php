<?php


namespace App\Core\Modules\Contract;

use App\Core\Models\Domain\Contract;

abstract class ContractModule {
    public $name;
    public $description;
    public $icon;
    public $place;
    public $isActive;
    public $configComponent;

    /**
     * @var Contract
     */
    private $contract;

    /**
     * @var array
     */
    private $attributes;

    /**
     * @var array
     */
    private $hooksArray;

    /**
     * @var array
     */
    private $defaultSettings;


    public function run(Contract &$contract, int $partType, array $attributes = []){
        $this->init($contract);
        $this->attributes = $attributes;

        return true;
    }

    public function init(Contract &$contract){
        $this->contract = $contract;

        return true;
    }

    protected function setDefaultSettings(array $settings){
        $this->defaultSettings = $settings;
    }

    protected function setHooksComponents(array $hooksArray){
        $this->hooksArray = $hooksArray;
    }

    protected function getModuleSettings(?string $secondKey = null){
        $moduleSettings = (isset($this->contract) && isset(((array)$this->contract->settings["modules"])[$this->name])) ? ((array)$this->contract->settings["modules"])[$this->name] : null;

        if(!isset($moduleSettings))
            $moduleSettings = $this->defaultSettings;

        if(!isset($moduleSettings) || !isset($secondKey))
            return $moduleSettings;
        else
            return isset(((array)$moduleSettings)[$secondKey]) ? ((array)$moduleSettings)[$secondKey] : null;
    }

    protected function getAttribute(string $attributeName){
        return isset(((array)$this->attributes)[$attributeName]) ? ((array)$this->attributes)[$attributeName] : null;
    }

    public function getInformation(): array{
        return [
            "name" => $this->name,
            "renderHooks" => $this->hooksArray,
            "settings" => $this->preventSettingsShow($this->getModuleSettings()),
            "description" => $this->description,
            "place" => $this->place,
            "icon" => $this->icon,
            "configComponent" => $this->configComponent,
        ];
    }

    protected function preventSettingsShow(?array $settings): array{
        if(!isset($settings)) return [];
        return $settings;
    }
}
