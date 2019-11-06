<?php

namespace App\Core\Services;

use App\Core\Models\User;
use Illuminate\Http\UploadedFile;

class UserService
{
    /**
     * @var \App\Core\Services\FileService
     */
    private $fileService;

    public function __construct(FileService $fileService) {
        $this->fileService = $fileService;
    }

    public function changeUserImage(int $userID, UploadedFile $newProfileImage): string {
        $user = User::findOrFail($userID);

        $this->fileService->removeFileUsingFileUrl($user->profileImage);

        $newFilePath = $this->fileService
            ->saveAndOptimizeImage($newProfileImage, 'profileImages');

        $user->update([
            "profileImage" => \Storage::url($newFilePath)
        ]);

        return $newFilePath;
    }
}
