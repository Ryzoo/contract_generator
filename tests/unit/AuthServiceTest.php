<?php

use App\Models\User;
use App\Services\AuthService;
use App\Services\UserService;
use Codeception\Test\Unit;

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

    // tests
    public function testRegisterUser() {
        $userModel = new User();
        $userModel->fill([
            "firstName" => "Adam",
            "lastName" => "Nowak",
            "email" => "a.nowak@gmail.com",
            "password" => bcrypt("fajnehaslo"),
            "role" => $this->userService::ROLE_CLIENT
        ]);

        $user = $this->authService->registerUser($userModel);

        $this->assertNotNull($user);
        $this->assertIsObject($user);
        $this->assertTrue(isset($user->id));
        $this->assertTrue(isset($user->role));
        $this->assertEquals($this->userService::ROLE_CLIENT,$user->role);
    }

    public function testLoginUser() {
        $facUser = factory(User::class)->states('client')->create([
            'password' => bcrypt("fajnehaslo"),
            'email' => "t.test@test.pl"
        ]);

        $user = $this->authService->loginUser("t.test@test.pl","fajnehaslo");

        $this->assertNotNull($user);
        $this->assertIsObject($user);
        $this->assertTrue(isset($user->id));
        $this->assertTrue(isset($user->role));
        $this->assertTrue(isset($user->loginToken));
        $this->assertEquals($this->userService::ROLE_CLIENT,$user->role);
    }
}