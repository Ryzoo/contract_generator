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
            'password' => bcrypt("fajnehaslo")
        ]);
        $this->roles['CLIENT'] = factory(User::class)->states('client')->create([
            'email' => "test@client.pl",
            'password' => bcrypt("fajnehaslo")
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
        $facUser = factory(User::class)->states('client')->make([
            'password' => 'fajnehaslo',
            'email' => "t.test@test.pl"
        ]);

        $I->sendPOST('api/auth/register',$facUser->getAttributes());
        $I->seeResponseCodeIs(HttpCode::OK);
        $I->seeResponseIsJson();
        $I->seeResponseContainsJson(['email' => 't.test@test.pl']);
    }
}