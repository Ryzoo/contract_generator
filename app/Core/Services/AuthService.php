<?php


namespace App\Core\Services;


use App\Jobs\Email\SendPasswordResetEmail;
use App\Jobs\Email\SendWelcomeEmail;
use App\Core\Models\User;
use App\Core\Repository\UserRepository;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Whoops\Exception\ErrorException;

class AuthService {

    /**
     * @var UserService
     */
    private $userService;

    /**
     * @var \App\Core\Repository\UserRepository
     */
    private $userRepository;

    public function __construct(UserService $userService, UserRepository $userRepository) {
        $this->userService = $userService;
        $this->userRepository = $userRepository;
    }

    public function loginUser(array $credentials): User {
        $user = $this->userRepository->getByEmail($credentials['email']);
        if(isset($user)){
            if(Hash::check($credentials['password'], $user->password)){
                return $user;
            }
            throw new ErrorException(__("response.badPassword"), 401);
        }
        throw new ErrorException(__("response.emailNotFound"), 401);
    }
}
