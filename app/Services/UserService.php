<?php

namespace App\Services;

use App\Helpers\Response;
use App\Models\User;

class UserService
{
    public function addUser(User $userModel):User {
        User::validate($userModel);

        $userModel->save();

        return $userModel;
    }

    public function updateUser(User $userModel) {
        $user = User::getById($userModel->id);

        if(isset($user)){
            $user->fill($userModel->getAttributes());
            User::validate($user,true);
            $user->save();
            return $user;
        }

        Response::error(__("response.notFoundId"),400);
    }

    public function removeUser(int $userID):bool {
        $user = User::getById($userID);

        if(isset($user)){
            $user->delete();
            return true;
        }

        return false;
    }
}
