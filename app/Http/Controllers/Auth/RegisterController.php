<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Core\Models\User;
use App\Core\Traits\ActivationTrait;
use App\Core\Traits\CaptchaTrait;
use App\Core\Traits\CaptureIpTrait;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use jeremykenedy\LaravelRoles\Models\Role;

class RegisterController extends Controller {

    use RegistersUsers;

    protected function validator(array $data) {
        return Validator::make($data,
            [
                'email' => 'required|email|unique:users,email|min:6|max:100',
                'firstName' => 'required|min:3|max:50',
                'lastName' => 'required|min:3|max:50',
                "password" => "required",
                "rePassword" => "required|same:password",
                "regulationsAccept" => "required|accepted",
                "rodoAccept" => "required|accepted",
            ]
        );
    }

    protected function create(array $data) {
        $role = Role::where('slug', 'user')->first();

        $user = User::create([
            'firstName' => $data['firstName'],
            'lastName' => $data['lastName'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'loginToken' => Str::random(80),
        ]);

        $user->attachRole($role);

        return $user;
    }

    protected function registered(Request $request, $user) {
        event(new Registered($user));
        return Response::json($user);
    }
}
