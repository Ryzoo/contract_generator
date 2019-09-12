<?php


namespace App\Services;


use App\Helpers\Response;
use App\Jobs\Email\SendPasswordResetEmail;
use App\Jobs\Email\SendWelcomeEmail;
use App\Models\User;
use App\Repository\UserRepository;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AuthService {

    /**
     * @var UserService
     */
    private $userService;

    /**
     * @var \App\Repository\UserRepository
     */
    private $userRepository;

    public function __construct(UserService $userService, UserRepository $userRepository) {
        $this->userService = $userService;
        $this->userRepository = $userRepository;
    }

    public function registerUser(User $userModel, int $userRole):?User {
        $userModel->role = $userRole;

        if(isset($userModel['regulationsAccept']))
            unset($userModel['regulationsAccept']);

        if(isset($userModel['rodoAccept']))
            unset($userModel['rodoAccept']);

        $user = $this->userService->addUser($userModel);

        SendWelcomeEmail::dispatchNow($user);

        return $user;
    }

    public function loginUser(string $email, string $password): User {
        $user = $this->userRepository->getByEmail($email);
        if(isset($user)){
            if(Hash::check($password, $user->password)){
                $user->loginToken = Str::random(60);
                $user->save();
                return $user;
            }
            throw new \Exception(__("response.badPassword"));
        }
        throw new \Exception(__("response.emailNotFound"));
    }

    public function authorizeLogedUser(string $loginToken) {
        $user = $this->userRepository->getByLoginToken($loginToken);

        if(!isset($user))
            throw new \Exception(__("response.notAuthorized"),404);

        return $user;
    }

    public function sendResetPasswordToken(string $email):string {
        $user = $this->userRepository->getByEmail($email);

        if(!isset($user))
            throw new \Exception(__("response.emailNotFound"),400);

        $resetPasswordToken = Str::random(60);
        $user->resetPasswordToken = $resetPasswordToken;
        $user->save();

        SendPasswordResetEmail::dispatchNow($user);

        return $resetPasswordToken;
    }

    public function resetUserPassword(string $resetToken, string $newPassword) {
        $user = $this->userRepository->getByResetToken($resetToken);

        if(!isset($user))
            Response::error(__("response.badResetToken"),400);

        $user->setPasswordAttribute($newPassword);
        $user->save();
    }
}
