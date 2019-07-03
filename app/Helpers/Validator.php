<?php

namespace App\Helpers;


class Validator {

    public static function validate(array $allRequest,array $rules):bool {
        $validator = \Illuminate\Support\Facades\Validator::make($allRequest, $rules);
        $errors = $validator
            ->errors()
            ->all();

        if (isset($errors) && count($errors) > 0) {
            Response::error($errors[0], 400);
            return FALSE;
        }
        return TRUE;
    }

}