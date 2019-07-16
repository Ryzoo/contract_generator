<?php

namespace App\Http\Controllers;

use App\Enums\UserRole;
use App\Helpers\Response;
use App\Helpers\Validator;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * @var \App\Services\UserService
     */
    protected $userService;

    public function __construct(UserService $userService) {
        $this->userService = $userService;
    }

    public function updateUserBasicData(Request $request, int $id) {
        Validator::validate($request->all(),[
            'firstName' => 'required|min:3|max:50',
            'lastName'  => 'required|min:3|max:50',
        ]);

        $userModel = new User();
        $userModel->fill([
            'id' => $id,
            'firstName' => $request->get('firstName'),
            'lastName'  => $request->get('lastName'),
        ]);

        $this->userService->updateUser($userModel);

        Response::success();
    }

    public function updateUserProfileImage(Request $request, int $id) {
        Validator::validate($request->all(),[
            'image' => 'required|image',
        ]);

        $this->userService->changeUserImage($id, $request->file('image'));
    }

    public function addNewUser(Request $request) {
        Validator::validate($request->all(),User::$rulesAddRequestCreate);

        $user = new User();
        $user->fill($request->all());

        $registeredUser = $this->userService->addUser($user);

        Response::success($registeredUser);
    }

    public function removeUserAccount(Request $request, int $id) {
        $this->userService->removeUser($id);
        Response::success();
    }

    public function getUserList(Request $request) {
        Response::success($this->userService->getUserList());
    }
}
