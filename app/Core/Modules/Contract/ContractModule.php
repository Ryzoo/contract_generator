<?php


namespace App\Core\Modules\Contract;

use App\Core\Models\Database\Contract;

abstract class ContractModule {
    public $slug;
    public $name;
    public $description;
    public $icon;
    public $place;
    public $isActive;
    public $configComponent;
    public $requirements = [];
    public $required = false;

    /**
     * @var Contract
     */
    protected $contract;

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


    public function run(Contract $contract, int $partType, array $attributes = []){
        $this->init($contract);
        $this->attributes = $attributes;

        return true;
    }

    public function init(Contract $contract){
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
            $moduleSettings = (array)$this->defaultSettings ?? null;

        if(!isset($moduleSettings) || !isset($secondKey))
            return (array)$moduleSettings;
        else
            return ((array)$moduleSettings)[$secondKey] ?? null;
    }

    protected function getAttribute(string $attributeName){
        return ((array)$this->attributes)[$attributeName] ?? null;
    }

    public function getInformation(): array{
        return [
            'slug' => $this->slug,
            'name' => $this->name,
            'renderHooks' => $this->hooksArray,
            'settings' => $this->preventSettingsShow($this->getModuleSettings()),
            'description' => $this->description,
            'place' => $this->place,
            'required' => $this->required,
            'requirements' => $this->requirements,
            'icon' => $this->icon,
            'configComponent' => $this->configComponent,
        ];
    }

    protected function preventSettingsShow(?array $settings): array{
        if(!isset($settings)) return [];
        return $settings;
    }
}
