<?php

use App\Models\User;

class UserServiceTest extends \Codeception\Test\Unit {

    /**
     * @var \UnitTester
     */
    protected $tester;

    /**
     * @var \App\Services\UserService
     */
    protected $userService;

    protected function _inject(\App\Services\UserService $userService){
        $this->userService = $userService;
    }

    protected function _before() {

    }

    protected function _after() {
    }

    // tests
    public function testAddClientUser() {
        $user = $this->userService->addUser("Adam",
            "Nowak","a.nowak@gmail.com","fajnehaslo",
            $this->userService::ROLE_CLIENT);

        $this->assertNotNull($user);
        $this->assertIsObject($user);
        $this->assertTrue(isset($user->id));
        $this->assertTrue(isset($user->role));
        $this->assertEquals($this->userService::ROLE_CLIENT,$user->role);
    }

    public function testAddAdminUser() {
        $user = $this->userService->addUser("Adam",
            "Nowak","a.nowak@gmail.com","fajnehaslo",
            $this->userService::ROLE_ADMIN);

        $this->assertNotNull($user);
        $this->assertIsObject($user);
        $this->assertTrue(isset($user->id));
        $this->assertTrue(isset($user->role));
        $this->assertEquals($this->userService::ROLE_ADMIN,$user->role);
    }

    public function testGetUserFromSeedsByEmail() {
        $user = $this->userService->getUserByEmail("t.client@test.pl");

        $this->assertNotNull($user);
        $this->assertIsObject($user);
        $this->assertTrue(isset($user->id));
        $this->assertTrue(isset($user->role));
        $this->assertEquals($this->userService::ROLE_CLIENT,$user->role);
    }

    public function testGetUserFromSeedsById() {
        $facUser = factory(User::class)->states('client')->create();

        $user = $this->userService->getUserById($facUser->id);

        $this->assertNotNull($user);
        $this->assertIsObject($user);
        $this->assertTrue(isset($user->id));
        $this->assertTrue(isset($user->role));
        $this->assertEquals($this->userService::ROLE_CLIENT,$user->role);
    }

}