<?php

namespace App\Http\Controllers;

use App\Core\Helpers\Response;
use App\Http\Requests\Users\UserUpdateRequest;
use App\Core\Models\User;
use App\Http\Requests\Users\UserAddRequest;
use App\Core\Services\UserService;
use App\Jobs\Email\SendWelcomeEmail;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * @var \App\Core\Services\UserService
     */
    protected $userService;

    public function __construct(UserService $userService) {
        $this->userService = $userService;
    }

    public function get(Request $request, int $id) {
        Response::success(User::findOrFail($id));
    }

    public function getCollection(Request $request) {
        Response::success(User::all());
    }

    public function add(UserAddRequest $request) {
        $user = User::create($request->validated());

        SendWelcomeEmail::dispatch($user);

        Response::success($user);
    }

    public function update(UserUpdateRequest $request, int $id) {
        $userModel = User::findOrFail($id);
        $userModel->update($request->validated());
        Response::success($userModel);
    }

    public function updateImage(UserUpdateRequest $request, int $id) {
        $newUrl = $this->userService->changeUserImage($id, $request->validated()["image"]);
        Response::success($newUrl);
    }

    public function remove(Request $request, int $id) {
        Response::success(User::destroy($id));
    }
}
