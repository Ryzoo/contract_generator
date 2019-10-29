<?php

namespace App\Core\Services;

use App\Core\Models\User;
use App\Core\Repository\UserRepository;
use Illuminate\Http\UploadedFile;
use Whoops\Exception\ErrorException;

class UserService
{
    /**
     * @var \App\Core\Services\FileService
     */
    private $fileService;

    /**
     * @var \App\Core\Repository\UserRepository
     */
    private $userRepository;

    public function __construct(FileService $fileService, UserRepository $userRepository) {
        $this->fileService = $fileService;
        $this->userRepository = $userRepository;
    }

    public function addUser(User $userModel):User {
        if(isset($userModel['rePassword']))
            unset($userModel['rePassword']);

        $userModel->save();

        return $userModel;
    }

    public function updateUser(User $userModel) {
        $user = $this->userRepository->getById($userModel->id);

        if(isset($user)){
            $user->fill($userModel->getAttributes());
            $user->save();
            return $user;
        }

        throw new ErrorException(__("response.notFoundId"));
    }

    public function removeUser(int $userID):bool {
        $user = $this->userRepository->getById($userID);

        if(isset($user)){
            $user->delete();
            return true;
        }

        return false;
    }

    public function changeUserImage(int $userID, UploadedFile $newProfileImage): string {
        $user = $this->userRepository->getById($userID);

        if(!isset($user))
            throw new ErrorException(__("response.notFoundId"));

        $this->fileService->removeFileUsingFileUrl($user->profileImage);

        $newFilePath = $this->fileService
            ->saveAndOptimizeImage($newProfileImage, 'profileImages');
        $user->profileImage = \Storage::url($newFilePath);

        $user->save();
        return $newFilePath;
    }
}
