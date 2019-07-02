<?php

namespace App\Http\Controllers;

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

        $userModel = $this->userService->updateUser($userModel);

        Response::success();
    }
}
