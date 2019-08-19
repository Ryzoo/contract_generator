<?php


namespace App\Services;


use App\Helpers\Response;
use App\Jobs\Email\SendPasswordResetEmail;
use App\Jobs\Email\SendWelcomeEmail;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

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

        if(isset($userModel['regulationsAccept']))
            unset($userModel['regulationsAccept']);

        if(isset($userModel['rodoAccept']))
            unset($userModel['rodoAccept']);

        $user = $this->userService->addUser($userModel);

        SendWelcomeEmail::dispatchNow($user);

        return $user;
    }

    public function loginUser(string $email, string $password) {
        $user = User::getByEmail($email);
        if(isset($user)){
            if(Hash::check($password, $user->password)){
                $user->loginToken = Str::random(60);
                $user->save();
                return $user;
            }else{
                Response::error(__("response.badPassword"),400);
            }
        }else{
            Response::error(__("response.emailNotFound"),400);
        }
    }

    public function authorizeLogedUser(string $loginToken) {
        $user = User::getByLoginToken($loginToken);

        if(!isset($user))
            Response::error(__("response.notAuthorized"),401);

        return $user;
    }

    public function sendResetPasswordToken(string $email):string {
        $user = User::getByEmail($email);

        if(!isset($user))
            Response::error(__("response.emailNotFound"),400);

        $resetPasswordToken = Str::random(60);
        $user->resetPasswordToken = $resetPasswordToken;
        $user->save();

        SendPasswordResetEmail::dispatchNow($user);

        return $resetPasswordToken;
    }

    public function resetUserPassword(string $resetToken, string $newPassword) {
        $user = User::getByResetToken($resetToken);

        if(!isset($user))
            Response::error(__("response.badResetToken"),400);

        $user->setPasswordAttribute($newPassword);
        $user->save();
    }
}