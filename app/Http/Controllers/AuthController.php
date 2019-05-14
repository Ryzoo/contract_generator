<?php

namespace App\Http\Controllers;

use App\Helpers\Response;
use App\Helpers\Validator;
use App\Models\User;
use App\Services\AuthService;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    protected $authService;

    public function __construct(AuthService $authService) {
        $this->authService = $authService;
    }

    public function loginUser(Request $request) {
        Validator::validate($request->all(),[
            "email" => "required|email",
            "password" => "required",
        ]);

        Response::json($this->authService->loginUser($request->get('email'),$request->get('password')));
    }

    public function registerUser(Request $request) {
        Validator::validate($request->all(),User::$rulesAdd);
        Response::json($this->authService->registerUser((new User())->fill($request->all())));
    }
}
