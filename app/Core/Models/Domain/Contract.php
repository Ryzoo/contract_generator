<?php

namespace App\Core\Models\Domain;

use App\Core\Models\Domain\Attributes\Attribute;
use App\Core\Models\Domain\Blocks\Block;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Collection;
use Whoops\Exception\ErrorException;

class Contract extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    protected $casts = [
        'attributesList' => 'array',
        'blocks' => 'array',
        'settings' => 'array',
    ];

    protected $appends = ['attributesList','blocks','settings'];

    public function getAttributesListAttribute($value): Collection
    {
        return collect(Attribute::getListFromString($value ?? $this->attributesList));
    }

    public function getBlocksAttribute($value): Collection
    {
        return collect(Block::getListFromString($value ?? $this->blocks));
    }

    public function getSettingsAttribute($value): Collection
    {
        return collect(json_decode($value ?? $this->settings));
    }

    public function getBlockCollection():Collection {
        $currentBlocks = $this->blocks;
        $blockCollection = collect();

        foreach ($currentBlocks as $block){
            $blockCollection = $block->getBlockCollection($blockCollection);
        }

        return $blockCollection;
    }

    public function getAttributeByID(int $attributeID):?Attribute {
        $attributes = $this->attributesList;

        foreach ($attributes as $attribute){
            if($attribute->id === $attributeID)
                return $attribute;
        }

        throw new ErrorException(__('validation.attributes.not_exist', ["id" => $attributeID]), 404);
    }

    public function setAttributesListAttribute($value)
    {
        $this->attributes['attributesList'] = json_encode($value);
    }

    public function setBlocksAttribute($value)
    {
        $this->attributes['blocks'] = json_encode($value);
    }

    public function setSettingsAttribute($value)
    {
        $this->attributes['settings'] = json_encode($value);
    }

    public function checkContractEnabledModules( string $moduleName ): bool{
        $enabledModules = isset($this->settings['enabledModules']) ? $this->settings['enabledModules'] : [];

        foreach ($enabledModules as $enabledModule) {
            if($enabledModule === $moduleName)
                return true;
        }

        return false;
    }

    public function form()
    {
        return $this->hasOne('App\Core\Models\Domain\Form');
    }
}
