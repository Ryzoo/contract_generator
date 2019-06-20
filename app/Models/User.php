<?php

namespace App\Models;

use App\Helpers\ElegantValidator;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends ElegantValidator
{
    use SoftDeletes;

    protected $guarded = [];

    public static $rulesAdd = array(
        'email'     => 'required|email|unique:users,email|min:6|max:100',
        'firstName' => 'required|min:3|max:50',
        'lastName'  => 'required|min:3|max:50',
        'role'      => 'required|digits_between:0,1',
        'password'  => 'required|min:6|max:255',
    );

    public static $rulesUpdate = array(
        'id'        => 'required',
        'email'     => 'required|email|min:6|max:100',
        'firstName' => 'required|min:3|max:50',
        'lastName'  => 'required|min:3|max:50',
        'role'      => 'required|digits_between:0,1',
        'password'  => 'required|min:6|max:255',
    );

    /**
     * Set the user password crypt
     *
     * @param  string  $password
     * @return void
     */
    public function setPasswordAttribute(string $password)
    {
        $this->attributes['password'] = bcrypt($password);
    }

    public static function getByEmail(string $email):?User {
        return User::where("email",$email)->first();
    }

    public static function getById(int $userID):?User{
        return User::where("id",$userID)->first();
    }

    public static function getByLoginToken(string $loginToken):?User {
        return User::where("loginToken",$loginToken)->first();
    }

}
