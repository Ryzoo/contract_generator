<?php


namespace App\Services;


use App\Helpers\Response;
use App\Jobs\SendWelcomeEmail;
use App\Mail\Welcome;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class AuthService {

    /**
     * @var UserService
     */
    private $userService;

    public function __construct(UserService $userService) {
        $this->userService = $userService;
    }

    public function registerUser(User $userModel):?User {
        $user = $this->userService->addUser($userModel);
//        SendWelcomeEmail::dispatch($user);
        // TODO - try to send email using dispatch
        Mail::to($userModel->email)
            ->send(new Welcome($userModel));

        return $user;
    }

    public function loginUser(string $email, string $password) {
        $user = $this->userService->getUserByEmail($email);
        if(isset($user)){
            if(Hash::check($password, $user->password)){
                return $user;
            }else{
                Response::error(__("response.bad_password"),401);
            }
        }else{
            Response::error(__("response.email_not_found"),401);
        }
    }
}