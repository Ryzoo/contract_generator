<?php

namespace App\Core\Models\Database;

use App\Core\Models\Domain\Attributes\Attribute;
use App\Core\Models\Domain\Blocks\Block;
use App\Core\Models\Domain\ContractSettings;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Collection;
use Whoops\Exception\ErrorException;
use App\Core\Models\Database\Form;
use App\Core\Models\Database\ContractFormComplete;
use App\Core\Models\Database\Category;

class Contract extends Model {
  use SoftDeletes;

  protected $guarded = [];
  protected $appends = ['attributesList', 'blocks', 'settings'];
  protected $casts = [
    'attributesList' => 'array',
    'blocks' => 'array',
    'settings' => 'array',
  ];

  public function getAttributesListAttribute($value): Collection {
    $currentValue = $value ?? $this->attributesList ?? NULL;
    return $currentValue ? collect(Attribute::getListFromString($currentValue)) : collect();
  }

  public function getBlocksAttribute($value): Collection {
    $currentValue = $value ?? $this->blocks ?? NULL;
    return $currentValue ? collect(Block::getListFromString($currentValue)) : collect();
  }

  public function getSettingsAttribute($value): ContractSettings {
    $currentValue = $value ?? NULL;
    return $currentValue ? ContractSettings::fromJson($currentValue) : $this->settings ?? new ContractSettings();
  }

  public function getBlockCollection(): Collection {
    $currentBlocks = $this->blocks;
    $blockCollection = collect();

    foreach ($currentBlocks as $block) {
      $blockCollection = $block->getBlockCollection($blockCollection);
    }

    return $blockCollection;
  }

  public function getAttributeByID(int $attributeID): ?Attribute {
    $attributes = $this->attributesList;
    $id = $attributeID;

    if(str_contains((string)$attributeID, ':')){
      [$id] = explode(':', (string)$attributeID);
    }

    foreach ($attributes as $attribute) {
      if ($attribute->id === $id) {
        return $attribute;
      }
    }

    throw new ErrorException(__('validation.attributes.not_exist', ['id' => $attributeID]), 404);
  }

  public function setAttributesListAttribute($value): void {
    $this->attributes['attributesList'] = json_encode($value, JSON_THROW_ON_ERROR, 512);
  }

  public function setBlocksAttribute($value): void {
    $this->attributes['blocks'] = json_encode($value, JSON_THROW_ON_ERROR, 512);
  }

  public function setSettingsAttribute(ContractSettings $value): void {
    $this->attributes['settings'] = json_encode($value, JSON_THROW_ON_ERROR, 512);
  }

  public function checkContractEnabledModules(string $moduleName): bool {
    foreach ($this->settings->enabledModules as $enabledModule) {
      if ($enabledModule === $moduleName) {
        return TRUE;
      }
    }

    return FALSE;
  }

  public function form(): \Illuminate\Database\Eloquent\Relations\HasOne {
    return $this->hasOne(Form::class);
  }

  public function completedForm(): \Illuminate\Database\Eloquent\Relations\HasMany {
    return $this->hasMany(ContractFormComplete::class);
  }

  public function categories(): \Illuminate\Database\Eloquent\Relations\BelongsToMany {
    return $this->belongsToMany(Category::class);
  }
}
