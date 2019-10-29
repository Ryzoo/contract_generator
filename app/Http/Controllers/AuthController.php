<?php

namespace App\Http\Controllers;

use App\Core\Enums\UserRole;
use App\Helpers\Response;
use App\Helpers\Validator;
use App\Core\Models\User;
use App\Core\Services\AuthService;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    /**
     * @var \App\Core\Services\AuthService
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
        Validator::validate($request->all(),User::$rulesAddRequestRegister);

        $user = new User();
        $user->fill($request->all());

        $registeredUser = $this->authService->registerUser( $user, UserRole::CLIENT );

        Response::json($registeredUser);
    }

    public function authorizeLogedUser(Request $request) {
        $loginToken = $request->bearerToken();

        $logedUser = $this->authService->authorizeLoggedUser( $loginToken );

        Response::json($logedUser);
    }

    public function sendResetUserPasswordToken(Request $request) {
        Validator::validate($request->all(),[
            "email" => "required",
        ]);

        $this->authService->sendResetPasswordToken( $request->get('email') );

        Response::success();
    }

    public function resetUserPassword(Request $request) {
        Validator::validate($request->all(),[
            "resetToken" => "required",
            "password" => "required",
            "rePassword" => "required|same:password",
        ]);

        $this->authService->resetUserPassword( $request->get('resetToken'), $request->get('password') );

        Response::success();
    }
}
