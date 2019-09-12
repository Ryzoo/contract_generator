<?php

namespace App\Models\Domain;;

use App\Helpers\ElegantValidator;
use App\Helpers\Response;
use App\Models\Domain\Attributes\Attribute;
use App\Models\Domain\Blocks\Block;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Collection;

class Contract extends ElegantValidator
{
    use SoftDeletes;

    protected $guarded = [];

    protected $casts = [
        'name' => 'required|string|between:5,190',
        'attributesList' => 'array',
        'blocks' => 'array',
        'settings' => 'array',
    ];

    public static $rulesAddRequestCreate= array(
        'name' => 'required|string|between:5,190',
        'attributesList'    => 'array',
        'blocks'        => 'array',
        'settings'      => 'array',
    );

    public static $rulesAdd = array(
        'name' => 'required|string|between:5,190',
        'attributesList'    => 'required|json',
        'blocks'        => 'required|json',
        'settings'      => 'required|json',
    );

    public static $rulesUpdate = array(
        'name' => 'required|string|between:5,190',
        'attributesList'    => 'required|json',
        'blocks'        => 'required|json',
        'settings'      => 'required|json',
    );

    /**
     * Get the attributes list
     *
     * @param string $value
     *
     * @return Collection
     * @throws \Exception
     */
    public function getAttributesListAttribute($value): Collection
    {
        return collect(Attribute::getListFromString($value));
    }

    /**
     * Get the blocks list
     *
     * @param string $value
     *
     * @return \Illuminate\Support\Collection
     */
    public function getBlocksAttribute($value): Collection
    {
        return collect(Block::getListFromString($value));
    }

    /**
     * Get the settings list
     *
     * @param  string  $value
     * @return Collection
     */
    public function getSettingsAttribute($value): Collection
    {
        return collect(json_decode($value));
    }

    public function getBlockCollection():Collection {
        $currentBlocks = $this->blocks;
        $blockCollection = collect();

        foreach ($currentBlocks as $block){
            $blockCollection = $block->getBlockCollection($blockCollection);
        }

        return $blockCollection;
    }

    /**
     * Set the attributes
     *
     * @param  string  $value
     * @return void
     */
    public function setAttributesListAttribute($value)
    {
        $this->attributes['attributesList'] = json_encode($value);
    }

    /**
     * Set the blocks
     *
     * @param  string  $value
     * @return void
     */
    public function setBlocksAttribute($value)
    {
        $this->attributes['blocks'] = json_encode($value);
    }

    /**
     * Set the settings
     *
     * @param  string  $value
     * @return void
     */
    public function setSettingsAttribute($value)
    {
        $this->attributes['settings'] = json_encode($value);
    }

    public function getAttributeByID(int $attributeID):?Attribute {
        $attributes = $this->attributesList;

        foreach ($attributes as $attribute){
            if($attribute->id === $attributeID)
                return $attribute;
        }

        Response::error(__('validation.attributes.not_exist', ["id" => $attributeID]), 404);
        return null;
    }

    public function form()
    {
        return $this->hasOne('App\Models\Domain\Form');
    }
}
