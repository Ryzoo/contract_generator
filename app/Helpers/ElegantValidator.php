<?php


namespace App\Helpers;

use Illuminate\Database\Eloquent\Model;

class ElegantValidator extends Model{
    protected static $rulesAdd = array();
    protected static $rulesUpdate = array();

    public static function validate($data, bool $isUpdate=false):bool {
        if(!isset($data) || !($data instanceof Model)){
            Response::error(__("validation.bad_object_data"),400);
        }

        return Validator::validate($data->getAttributes(),$isUpdate ? static::$rulesUpdate : static::$rulesAdd);
    }

}