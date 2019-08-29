<?php

namespace App\Services;

use App\Helpers\Response;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Collection;

class UserService
{
    /**
     * @var \App\Services\FileService
     */
    private $fileService;

    public function __construct(FileService $fileService) {
        $this->fileService = $fileService;
    }

    public function addUser(User $userModel):User {
        if(isset($userModel['rePassword']))
            unset($userModel['rePassword']);

        User::validate($userModel);

        $userModel->save();

        return $userModel;
    }

    public function getUserList():Collection {
        return User::all();
    }

    public function updateUser(User $userModel) {
        $user = User::getById($userModel->id);

        if(isset($user)){
            $user->fill($userModel->getAttributes());
            User::validate($user,true);
            $user->save();
            return $user;
        }

        throw new \Exception(__("response.notFoundId"));
    }

    public function removeUser(int $userID):bool {
        $user = User::getById($userID);

        if(isset($user)){
            $user->delete();
            return true;
        }

        return false;
    }

    public function changeUserImage(int $userID, UploadedFile $newProfileImage): string {
        $user = User::getById($userID);

        if(!isset($user))
            throw new \Exception(__("response.notFoundId"));

        $this->fileService->removeFileUsingFileUrl($user->profileImage);

        $newFilePath = $this->fileService
            ->saveAndOptimizeImage($newProfileImage, 'profileImages');
        $user->profileImage = \Storage::url($newFilePath);

        $user->save();
        return $newFilePath;
    }
}
