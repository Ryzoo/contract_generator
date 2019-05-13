<?php

namespace App\Models;

use App\Helpers\ElegantValidator;

class User extends ElegantValidator
{
    protected $guarded = [];
    protected $rules = array(
        'email' => 'required|email|unique:users,email',
        'firstName'  => 'required',
        'lastName'  => 'required',
        'role'  => 'required',
    );
}
