<?php

namespace App\Helpers;


class Validator {

    public static function validate(array $allRequest,array $rules):bool {
        $validator = \Illuminate\Support\Facades\Validator::make($allRequest, $rules);
        $errors = $validator
            ->errors()
            ->all();

        if (count($errors) > 0) {
            throw new \Exception($errors[0]);
            return FALSE;
        }
        return TRUE;
    }

}
