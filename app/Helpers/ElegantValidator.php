<?php


namespace App\Helpers;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Helpers\ElegantValidator
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Helpers\ElegantValidator newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Helpers\ElegantValidator newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Helpers\ElegantValidator query()
 * @mixin \Eloquent
 */
class ElegantValidator extends Model{
    public static $rulesAdd = array();
    public static $rulesUpdate = array();

    public static function validate($data, bool $isUpdate=false):bool {
        if(!isset($data) || !($data instanceof Model)){
            throw new \Exception(__("validation.bad_object_data"));
        }

        return Validator::validate($data->getAttributes(),$isUpdate ? static::$rulesUpdate : static::$rulesAdd);
    }
}
