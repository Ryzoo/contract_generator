<?php

namespace App\Services;

use App\Helpers\Response;
use App\Models\User;

class UserService
{
    public const ROLE_CLIENT = 0;
    public const ROLE_ADMIN = 1;

    public function addUser(string $firstName, string $lastName, string $email, string $password, int $role = self::ROLE_CLIENT):User {
        $userData = [
            'firstName' => $firstName,
            'lastName' => $lastName,
            'email' => $email,
            'password' => bcrypt($password),
            'role' => $role
        ];

        $user = new User();

        if($user->validate($userData)){
            $user = User::create($userData);

            //TODO add notification to admin and email to client

            return $user;
        }else{
            Response::error($user->errors()[0],400);
        }
    }

    public function getUserByEmail(string $email):?User {
        return User::where("email",$email)->first();
    }

    public function getUserById(int $userID):?User{
        return User::find($userID);
    }

    public function removeUser(int $userID):bool {
        $user = $this->getUserById($userID);
        if(isset($user)){
            $user->forceDelete();
            return true;
        }else{
            return false;
        }
    }
}
