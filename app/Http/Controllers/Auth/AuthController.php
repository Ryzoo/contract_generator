<?php

namespace App\Http\Controllers\Auth;

use App\Core\Models\User;
use App\Core\Services\AuthService;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;

class AuthController extends Controller
{
    /**
     * @var \App\Core\Services\AuthService
     */
    private $authService;

    public function __construct(AuthService $authService) {
        $this->authService = $authService;
        $this->middleware('auth:token');
    }

    protected function authorizeLoggedUser(Request $request) {
        $id = Auth::id();
        $user = User::with('roles')->findOrFail($id);
        $permissions = $user->getPermissions();
        $user->permissions = $permissions;

        return Response::json($user);
    }

}
