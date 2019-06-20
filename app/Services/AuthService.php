<?php


namespace App\Services;


use App\Helpers\Response;
use App\Jobs\Email\SendWelcomeEmail;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthService {

    /**
     * @var UserService
     */
    private $userService;

    public function __construct(UserService $userService) {
        $this->userService = $userService;
    }

    public function registerUser(User $userModel, int $userRole):?User {
        $userModel->role = $userRole;

        if(isset($userModel['rePassword']))
            unset($userModel['rePassword']);

        $user = $this->userService->addUser($userModel);

        SendWelcomeEmail::dispatchNow($user);

        return $user;
    }

    public function loginUser(string $email, string $password) {
        $user = User::getByEmail($email);
        if(isset($user)){
            if(Hash::check($password, $user->password)){
                return $user;
            }else{
                Response::error(__("response.badPassword"),401);
            }
        }else{
            Response::error(__("response.emailNotFound"),401);
        }
    }

    public function authorizeLogedUser(string $loginToken) {
        $user = User::getByLoginToken($loginToken);

        if(!isset($user))
            Response::error(__("response.notAuthorized"),401);

        return $user;
    }
}