<?php

namespace App\Models\Domain;;

use App\Helpers\ElegantValidator;
use App\Models\Domain\Attributes\Attribute;
use App\Models\Domain\Blocks\Block;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contract extends ElegantValidator
{
    use SoftDeletes;

    protected $guarded = [];

    protected $casts = [
        'attributes' => 'array',
        'blocks' => 'array',
        'settings' => 'array',
    ];

    public static $rulesAddRequestCreate= array(
        'attributes'    => 'array',
        'blocks'        => 'array',
        'settings'      => 'array',
    );

    public static $rulesAdd = array(
        'attributes'    => 'required|json',
        'blocks'        => 'required|json',
        'settings'      => 'required|json',
    );

    public static $rulesUpdate = array(
        'attributes'    => 'required|json',
        'blocks'        => 'required|json',
        'settings'      => 'required|json',
    );

    /**
     * Get the attributes list
     *
     * @param  string  $value
     * @return array
     */
    public function getAttributesAttribute($value): array
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

    /**
     * Set the attributes
     *
     * @param  string  $value
     * @return void
     */
    public function setAttributesAttribute($value)
    {
        $this->attributes['attributes'] = json_encode($value);
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
}
