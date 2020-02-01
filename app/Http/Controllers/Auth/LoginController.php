<?php

namespace App\Http\Controllers\Auth;

use App\Core\Models\Database\User;
use App\Core\Services\AuthService;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Str;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    /**
     * @var \App\Core\Services\AuthService
     */
    private $authService;

    public function __construct(AuthService $authService) {
        $this->authService = $authService;
    }

    protected function authenticated(Request $request,User $user) {
        $user->update([
            'loginToken' => Str::random(80)
        ]);

        return Response::json($user);
    }

    protected function attemptLogin(Request $request)
    {
        $user = $this->authService->loginUser($this->credentials($request));
        Auth::setUser($user);

        return true;
    }

    protected function sendLoginResponse(Request $request)
    {
        $user = Auth::user();

        $user->update([
            'loginToken' => Str::random(80)
        ]);

        $permissions = $user->getPermissions();
        $user->permissions = $permissions;

        return Response::json($user);
    }
}
