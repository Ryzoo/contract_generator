<?php


namespace App\Repository;


use App\Models\User;
use Illuminate\Support\Collection;

class UserRepository {
    public function getUserList():Collection {
        return User::all();
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
