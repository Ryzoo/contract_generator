<?php

use App\Enums\UserRole;
use App\Models\User;
use App\Services\AuthService;
use App\Services\UserService;
use Codeception\Test\Unit;
use Illuminate\Support\Str;

class AuthServiceTest extends Unit {

    /**
     * @var \UnitTester
     */
    protected $tester;

    /**
     * @var \App\Services\AuthService
     */
    protected $authService;

    /**
     * @var \App\Services\UserService
     */
    protected $userService;

    protected function _inject(AuthService $authService, UserService $userService) {
        $this->authService = $authService;
        $this->userService = $userService;
    }

    public function testRegisterUser() {
        $userModel = new User();
        $userModel->fill([
            "firstName" => "Adam",
            "lastName" => "Nowak",
            "email" => "a.nowak@gmail.com",
            "password" => "fajnehaslo",
            "role" => UserRole::CLIENT
        ]);

        $user = $this->authService->registerUser($userModel,UserRole::CLIENT);

        $this->assertNotNull($user);
        $this->assertIsObject($user);
        $this->assertTrue(isset($user->id));
        $this->assertTrue(isset($user->role));
        $this->assertEquals(UserRole::CLIENT,$user->role);
    }

    public function testLoginUser() {
        factory(User::class)->states('client')->create([
            'password' => "fajnehaslo",
            'email' => "t.test@test.pl"
        ]);

        $user = $this->authService->loginUser("t.test@test.pl","fajnehaslo");

        $this->assertNotNull($user);
        $this->assertIsObject($user);
        $this->assertTrue(isset($user->id));
        $this->assertTrue(isset($user->role));
        $this->assertTrue(isset($user->loginToken));
        $this->assertEquals(UserRole::CLIENT,$user->role);
    }

    public function testAuthorizeUser() {
        factory(User::class)->states('client')->create([
            'password' => "fajnehaslo",
            'email' => "t.test@test.pl"
        ]);

        $user = $this->authService->loginUser("t.test@test.pl","fajnehaslo");
        $authUser = $this->authService->authorizeLogedUser($user->loginToken);

        $this->assertNotNull($authUser);
        $this->assertIsObject($authUser);
        $this->assertTrue(isset($authUser->id));
        $this->assertTrue(isset($authUser->role));
        $this->assertTrue(isset($authUser->loginToken));
        $this->assertEquals(UserRole::CLIENT,$authUser->role);
    }

    public function testSendResetPasswordToken() {
        factory(User::class)->states('client')->create([
            'password' => "fajnehaslo",
            'email' => "t.test@test.pl"
        ]);

        $resetToken = $this->authService->sendResetPasswordToken("t.test@test.pl");

        $this->assertNotNull($resetToken);
        $this->assertIsString($resetToken);
        $this->assertTrue(Str::length($resetToken) === 60);
    }

    public function testResetUserPassword() {
        factory(User::class)->states('client')->create([
            'password' => "fajnehaslo",
            'email' => "t.test@test.pl"
        ]);

        $resetToken = $this->authService->sendResetPasswordToken("t.test@test.pl");
        $this->authService->resetUserPassword($resetToken,"fajne");

        $user = $this->authService->loginUser("t.test@test.pl","fajne");

        $this->assertNotNull($user);
        $this->assertIsObject($user);
        $this->assertTrue(isset($user->id));
        $this->assertTrue(isset($user->role));
        $this->assertTrue(isset($user->loginToken));
        $this->assertEquals(UserRole::CLIENT,$user->role);
    }

}