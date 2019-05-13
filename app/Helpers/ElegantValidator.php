<?php


namespace App\Helpers;


use Illuminate\Database\Eloquent\Model;

class ElegantValidator extends Model{

    protected $rules = [];

    protected $errors;

    public function validate($data) {
        $v = \Illuminate\Support\Facades\Validator::make($data, $this->rules);

        if ($v->fails()) {
            $this->errors = $v->errors;
            return FALSE;
        }

        return TRUE;
    }

    public function errors() {
        return $this->errors;
    }
}