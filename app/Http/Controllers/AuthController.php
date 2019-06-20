<?php

namespace App\Http\Controllers;

use App\Enums\UserRole;
use App\Helpers\Response;
use App\Helpers\Validator;
use App\Models\User;
use App\Services\AuthService;
use Illuminate\Http\Request;

class AuthController extends Controller
{

    /**
     * @var \App\Services\AuthService
     */
    protected $authService;

    public function __construct(AuthService $authService) {
        $this->authService = $authService;
    }

    public function loginUser(Request $request) {
        Validator::validate($request->all(),[
            "email" => "required|email",
            "password" => "required",
        ]);

        $logedUser = $this->authService->loginUser(
            $request->get('email'),
            $request->get('password')
        );

        Response::json($logedUser);
    }

    public function registerUser(Request $request) {
        Validator::validate($request->all(),User::$rulesAdd);
        Validator::validate($request->all(),[
            "password" => "required",
            "rePassword" => "required|same:password",
        ]);

        $user = new User();
        $user->fill($request->all());

        $registeredUser = $this->authService->registerUser( $user, UserRole::CLIENT );

        Response::json($registeredUser);
    }

    public function authorizeLogedUser(Request $request) {
        $loginToken = $request->bearerToken();

        $logedUser = $this->authService->authorizeLogedUser( $loginToken );

        Response::json($logedUser);
    }

    public function resetUserPassword(Request $request) {
        Validator::validate($request->all(),[
            "email" => "required",
        ]);

        $this->authService->resetPassword( $request->get('email') );

        Response::success();
    }
}
