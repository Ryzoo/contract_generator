<?php

namespace App\Models;

use App\Helpers\ElegantValidator;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\User
 *
 * @property int $id
 * @property string $firstName
 * @property string $lastName
 * @property string $email
 * @property string $password
 * @property int $role
 * @property string|null $loginToken
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereFirstName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereLastName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereLoginToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereRole($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User withoutTrashed()
 * @mixin \Eloquent
 */
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

    public static function getByResetToken(string $resetPasswordToken):?User {
        return User::where("resetPasswordToken",$resetPasswordToken)->first();
    }

    public static function getById(int $userID):?User{
        return User::where("id",$userID)->first();
    }

    public static function getByLoginToken(string $loginToken):?User {
        return User::where("loginToken",$loginToken)->first();
    }

}
