<?php

namespace App\Http\Controllers;

use App\Core\Helpers\Response;
use App\Http\Requests\Users\UserDeleteRequest;
use App\Http\Requests\Users\UserPasswordChangeRequest;
use App\Http\Requests\Users\UserUpdateRequest;
use App\Core\Models\Database\User;
use App\Http\Requests\Users\UserAddRequest;
use App\Core\Services\UserService;
use App\Jobs\Email\SendWelcomeEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    protected UserService $userService;

    public function __construct(UserService $userService) {
        $this->userService = $userService;
    }

    public function get(Request $request, int $id) {
        Response::success(User::with('roles')->findOrFail($id));
    }

    public function getCollection(Request $request) {
        Response::success(User::with('roles')->get());
    }

    public function add(UserAddRequest $request) {
        $requestData = collect($request->validated());
        $requestData['password'] = Hash::make($requestData['password']);

        $userModel = User::create($requestData->except(['roles'])->toArray());
        $userModel->syncRoles($requestData['roles']);

        SendWelcomeEmail::dispatch($userModel);
        Response::success($userModel);
    }

    public function update(UserUpdateRequest $request, int $id) {
        $requestData = collect($request->validated());
        $userModel = User::findOrFail($id);
        $userModel->update($requestData->except(['roles'])->toArray());
        $userModel->syncRoles($requestData['roles']);
        Response::success($userModel);
    }

    public function updateImage(UserUpdateRequest $request, int $id) {
        $newUrl = $this->userService->changeUserImage($id, $request->validated()['image']);
        Response::success($newUrl);
    }

    public function changePassword(UserPasswordChangeRequest $request, int $id)
    {
        $this->userService->changeUserPassword($id, $request->validated()['password']);
        Response::success();
    }

    public function remove(UserDeleteRequest $request, int $id) {
        Response::success(User::destroy($id));
    }
}
