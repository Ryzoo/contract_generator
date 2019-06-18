<?php

namespace App\Http\Controllers;

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

        $user = new User();
        $user->fill($request->all());

        $registeredUser = $this->authService->registerUser( $user );

        Response::json($registeredUser);
    }

    public function authorizeLogedUser(Request $request) {
        $loginToken = $request->bearerToken();

        $logedUser = $this->authService->authorizeLogedUser( $loginToken );

        Response::json($logedUser);
    }
}
