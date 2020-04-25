<?php


namespace App\Core\Models\Domain;


class ContractSettings {
  public $modules = '';
  public array $enabledModules = [];
  public int $counterStart = 1;
  public string $counterType = 'number';
  public string $font = 'DejaVu Serif';
  public string $fontSize = '14px';

  public static function fromJson(string $jsonString): ContractSettings {
    $jsonData = json_decode($jsonString, TRUE, 512, JSON_THROW_ON_ERROR);
    return self::fromArray((array)$jsonData);
  }

  public static function fromArray(array $arraySettings):ContractSettings {
    $instance = new self();

    $instance->enabledModules = $arraySettings['enabledModules'] ??  $instance->enabledModules;
    $instance->modules = $arraySettings['modules'] ??  $instance->modules;
    $instance->counterStart = $arraySettings['counterStart'] ??  $instance->counterStart;
    $instance->counterType = $arraySettings['counterType'] ??  $instance->counterType;
    $instance->font = $arraySettings['font'] ??  $instance->font;
    $instance->fontSize = $arraySettings['fontSize'] ??  $instance->fontSize;

    return $instance;
  }
}
