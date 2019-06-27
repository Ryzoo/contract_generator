<?php

use App\Models\User;
use App\Services\AuthService;
use App\Services\UserService;
use Codeception\Util\HttpCode;

class AuthCest {

    private $roles = [
        "ADMIN" => NULL,
    ];

    /**
     * @var \App\Services\AuthService
     */
    protected $authService;

    protected function _inject(AuthService $authService) {
        $this->authService = $authService;
    }

    public function _before(ApiTester $I) {
        $this->roles['ADMIN'] = factory(User::class)->states('admin')->create([
            'email' => "test@admin.pl",
            'password' => "fajnehaslo"
        ]);
        $this->roles['CLIENT'] = factory(User::class)->states('client')->create([
            'email' => "test@client.pl",
            'password' => "fajnehaslo"
        ]);
    }

    public function tryLogin(ApiTester $I) {
        $I->sendPOST('api/auth/login',[
            'email' => 'test@admin.pl',
            'password' => 'fajnehaslo',
        ]);
        $I->seeResponseCodeIs(HttpCode::OK);
        $I->seeResponseIsJson();
        $I->seeResponseContainsJson(['email' => 'test@admin.pl']);
    }

    public function tryRegister(ApiTester $I) {
        $facUser = factory(User::class)->states('client')->make();

        $data = $facUser->getAttributes();
        $data['password'] = 'fajnehaslo';
        $data['rePassword'] = 'fajnehaslo';
        $data['email'] = 't.test@test.pl';
        $data['regulationsAccept'] = true;
        $data['rodoAccept'] = true;

        $I->sendPOST('api/auth/register',$data);

        $I->seeResponseCodeIs(HttpCode::OK);
        $I->seeResponseIsJson();
        $I->seeResponseContainsJson(['email' => 't.test@test.pl']);
    }

    public function tryAuthorize(ApiTester $I) {
        $I->amBearerAuthenticated($this->roles['CLIENT']->loginToken);

        $I->sendPOST('api/auth/authorize');

        $I->seeResponseCodeIs(HttpCode::OK);
        $I->seeResponseIsJson();
        $I->seeResponseContainsJson(['email' => 'test@client.pl']);
    }

    public function trySendResetPasswordToken(ApiTester $I) {
        $I->sendPOST('api/auth/resetPassword/sendToken',[
            'email' => $this->roles['CLIENT']->email
        ]);

        $I->seeResponseCodeIs(HttpCode::OK);
        $I->seeResponseIsJson();
    }

    public function tryResetPassword(ApiTester $I) {
        $data = [];
        $data["resetToken"] = $this->authService->sendResetPasswordToken($this->roles['CLIENT']->email);
        $data["password"] = "fajne";
        $data["rePassword"] = "fajne";

        $I->sendPOST('api/auth/resetPassword',$data);

        $I->seeResponseCodeIs(HttpCode::OK);
        $I->seeResponseIsJson();
    }
}