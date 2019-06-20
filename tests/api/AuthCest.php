<?php

use App\Models\User;
use Codeception\Util\HttpCode;

class AuthCest {

    private $roles = [
        "ADMIN" => NULL,
    ];

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
}