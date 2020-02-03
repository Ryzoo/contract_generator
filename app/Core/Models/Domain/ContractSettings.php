<?php


namespace App\Core\Models\Domain;


class ContractSettings {
  public $enabledModules = [];
  public $modules = null;
  public $counterStart = 1;
  public $counterType= 'number';

  public static function fromJson(string $jsonString): ContractSettings {
    $jsonData = json_decode($jsonString);
    $instance = new self();

    $instance->enabledModules = $jsonData->enabledModules ??  $instance->enabledModules;
    $instance->modules = $jsonData->modules ??  $instance->modules;
    $instance->counterStart = $jsonData->counterStart ??  $instance->counterStart;
    $instance->counterType = $jsonData->counterType ??  $instance->counterType;

    return $instance;
  }
}
