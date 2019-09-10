<?php

namespace App\Http\Controllers;

use App\Enums\UserRole;
use App\Helpers\Response;
use App\Helpers\Validator;
use App\Models\User;
use App\Repository\UserRepository;
use App\Services\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * @var \App\Services\UserService
     */
    protected $userService;

    /**
     * @var \App\Repository\UserRepository
     */
    private $userRepository;

    public function __construct(UserService $userService, UserRepository $userRepository) {
        $this->userService = $userService;
        $this->userRepository = $userRepository;
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

    public function updateUser(Request $request, int $id) {
        Validator::validate($request->all(),[
            'firstName' => 'required|min:3|max:50',
            'lastName'  => 'required|min:3|max:50',
            'role'  => 'required|digits_between:0,1',
        ]);

        $userModel = new User();
        $userModel->fill([
            'id' => $id,
            'firstName' => $request->get('firstName'),
            'lastName'  => $request->get('lastName'),
            'role'  => $request->get('role'),
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

    public function getUserByID(Request $request, int $id) {
        $user = $this->userRepository->getById($id);

        if(!isset($user))
            Response::error("User not found", 404);

        Response::success($user);
    }

    public function getUserList(Request $request) {
        Response::success($this->userRepository->getUserList());
    }
}
