<?php


namespace App\Core\Modules\Contract;

use App\Core\Models\Database\Contract;
use App\Core\Models\Domain\ContractSettings;

abstract class ContractModule {

  public $slug;

  public $name;

  public $description;

  public $icon;

  public $place;

  public $isActive;

  public $configComponent;

  public $requirements = [];

  public $required = FALSE;

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
  private $defaultSettings = [];


  public function run(Contract $contract, int $partType, array $attributes = []): bool {
    $this->init($contract);
    $this->attributes = $attributes;

    return TRUE;
  }

  public function init(Contract $contract): bool {
    $this->contract = $contract;

    return TRUE;
  }

  protected function setDefaultSettings(array $settings): void {
    $this->defaultSettings = $settings;
  }

  protected function setHooksComponents(array $hooksArray): void {
    $this->hooksArray = $hooksArray;
  }

  protected function getModuleSettings(?string $secondKey = NULL) {
    /**
     * @var ContractSettings $contractSettings
     */
    $contractSettings = isset($this->contract) ? $this->contract->settings : NULL;
    $moduleSettings = isset($contractSettings) ? ((array) $contractSettings->modules)[$this->slug] ?? NULL : null;

    if (!isset($moduleSettings)) {
      $moduleSettings = $this->defaultSettings ?? NULL;
    }

    if (!isset($moduleSettings, $secondKey)) {
      return (array) $moduleSettings;
    }

    return ((array) $moduleSettings)[$secondKey] ?? NULL;
  }

  protected function getAttribute(string $attributeName) {
    return ((array) $this->attributes)[$attributeName] ?? NULL;
  }

  public function getInformation(): array {
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

  protected function preventSettingsShow(?array $settings): array {
    if (!isset($settings)) {
      return [];
    }
    return $settings;
  }
}
