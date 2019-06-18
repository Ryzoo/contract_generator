<?php

namespace App\Services;

use App\Helpers\Response;
use App\Models\User;

class UserService
{
    public const ROLE_CLIENT = 0;
    public const ROLE_ADMIN = 1;

    public function addUser(User $userModel):User {
        User::validate($userModel);
        $userModel->password = bcrypt($userModel->password);
        $userModel->save();
        return $userModel;
    }

    public function getUserByEmail(string $email):?User {
        return User::where("email",$email)->first();
    }

    public function getUserById(int $userID):?User{
        return User::find($userID);
    }

    public function getUserByLoginToken(string $loginToken):?User {
        return User::where("loginToken",$loginToken)->first();
    }

    public function updateUser(User $userModel) {
        $user = $this->getUserById($userModel->id);
        if(isset($user)){
            $user->fill($userModel->getAttributes());
            User::validate($user,true);
            $user->save();
            return $user;
        }else{
            Response::error(__("response.notFoundId"),400);
        }
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
