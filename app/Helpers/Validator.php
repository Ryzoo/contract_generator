<?php

namespace App\Helpers;


use Whoops\Exception\ErrorException;

class Validator {

    public static function validate(array $allRequest,array $rules):bool {
        $validator = \Illuminate\Support\Facades\Validator::make($allRequest, $rules);
        $errors = $validator
            ->errors()
            ->all();

        if (count($errors) > 0) {
            throw new ErrorException($errors[0]);
        }

        return TRUE;
    }

}
