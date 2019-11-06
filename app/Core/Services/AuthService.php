<?php


namespace App\Core\Services;


use App\Core\Models\User;
use Illuminate\Support\Facades\Hash;
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
            ->firstOrFail();

            if(!Hash::check($credentials['password'], $user->password))
                throw new ErrorException(__("response.badPassword"), 401);

        return $user;
    }
}
