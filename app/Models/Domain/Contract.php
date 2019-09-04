<?php

namespace App\Models\Domain;;

use App\Contracts\Domain\IAttribute;
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
     * @param  string  $value
     * @return array
     */
    public function getAttributesListAttribute($value): array
    {
        return Attribute::getListFromString($value);
    }

    /**
     * Get the blocks list
     *
     * @param  string  $value
     * @return array
     */
    public function getBlocksAttribute($value): array
    {
        return Block::getListFromString($value);
    }

//    /**
//     * Get the settings list
//     *
//     * @param  string  $value
//     * @return array
//     */
//    public function getSettingsAttribute($value): array
//    {
//        return Settings::getListFromString($value);
//    }

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

    public static function getById(int $contractID):?Contract{
        $contract = Contract::where("id", $contractID)->first();

        if(!isset($contract))
            Response::error(__("response.notFoundId"),404);

        return $contract;
    }

    public function getAttributeByID(int $attributeID):IAttribute {
        $attributes = $this->attributesList;

        foreach ($attributes as $attribute){
            if($attribute->id === $attributeID)
                return $attribute;
        }

        Response::error(__('validation.attributes.not_exist', ["id" => $attributeID]), 404);
    }

    public function form()
    {
        return $this->hasOne('App\Models\Domain\Form');
    }
}
