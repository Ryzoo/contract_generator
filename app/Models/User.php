<?php

namespace App\Models;

use App\Helpers\ElegantValidator;

class User extends ElegantValidator
{
    protected $guarded = [];

    public static $rulesAdd = array(
        'email' => 'required|email|unique:users,email|min:6|max:100',
        'firstName'  => 'required|min:3|max:50',
        'lastName'  => 'required|min:3|max:50',
        'role'  => 'required|digits_between:0,1',
    );

    public static $rulesUpdate = array(
        'email' => 'required|email|min:6|max:100',
        'firstName'  => 'required|min:3|max:50',
        'lastName'  => 'required|min:3|max:50',
        'role'  => 'required|digits_between:0,1',
    );
}
