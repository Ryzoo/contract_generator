<?php


namespace App\Core\Services;


use App\Core\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Whoops\Exception\ErrorException;

class AuthService {

    /**
     * @var UserService
     */
    private $userService;

    public function __construct(UserService $userService) {
        $this->userService = $userService;
    }

    public function loginUser(array $credentials): User {
        $user = User::where("email",$credentials['email'])
            ->first();

        if(!isset($user))
            throw new ErrorException(__("response.emailNotFound"), 401);

        if(!Hash::check($credentials['password'], $user->password))
            throw new ErrorException(__("response.badPassword"), 401);

        $user->update([
            'loginToken' => Str::random(80)
        ]);

        return $user;
    }
}
