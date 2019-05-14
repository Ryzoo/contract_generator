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
        $userModel = new User();
        $userModel->fill([
            "firstName" => "Adam",
            "lastName" => "Nowak",
            "email" => "a.nowak@gmail.com",
            "password" => bcrypt("fajnehaslo"),
            "role" => $this->userService::ROLE_CLIENT
        ]);

        $user = $this->userService->addUser($userModel);

        $this->assertNotNull($user);
        $this->assertIsObject($user);
        $this->assertTrue(isset($user->id));
        $this->assertTrue(isset($user->role));
        $this->assertEquals($this->userService::ROLE_CLIENT,$user->role);
    }

    public function testAddAdminUser() {
        $userModel = new User();
        $userModel->fill([
            "firstName" => "Adam",
            "lastName" => "Nowak",
            "email" => "a.nowak@gmail.com",
            "password" => bcrypt("fajnehaslo"),
            "role" => $this->userService::ROLE_ADMIN
        ]);

        $user = $this->userService->addUser($userModel);

        $this->assertNotNull($user);
        $this->assertIsObject($user);
        $this->assertTrue(isset($user->id));
        $this->assertTrue(isset($user->role));
        $this->assertEquals($this->userService::ROLE_ADMIN,$user->role);
    }

    public function testGetUserByEmail() {
        $user = $this->userService->getUserByEmail("t.client@test.pl");

        $this->assertNotNull($user);
        $this->assertIsObject($user);
        $this->assertTrue(isset($user->id));
        $this->assertTrue(isset($user->role));
        $this->assertEquals($this->userService::ROLE_CLIENT,$user->role);
    }

    public function testGetUserById() {
        $facUser = factory(User::class)->states('client')->create();

        $user = $this->userService->getUserById($facUser->id);

        $this->assertNotNull($user);
        $this->assertIsObject($user);
        $this->assertTrue(isset($user->id));
        $this->assertTrue(isset($user->role));
        $this->assertEquals($this->userService::ROLE_CLIENT,$user->role);
    }

    public function testRemoveUser() {
        $facUser = factory(User::class)->states('client')->create();
        $this->assertTrue($this->userService->removeUser($facUser->id));
    }

    public function testUpdateUser() {
        $facUser = factory(User::class)->states('client')->create();

        $userModel = new User();
        $userModel->fill([
            "id" => $facUser->id,
            "lastName" => "Inny",
            "email" => "a.inny@gmail.com",
        ]);

        $user = $this->userService->updateUser($userModel);

        $this->assertNotNull($user);
        $this->assertIsObject($user);
        $this->assertTrue(isset($user->id));
        $this->assertTrue(isset($user->role));
        $this->assertEquals($this->userService::ROLE_CLIENT,$user->role);
        $this->assertEquals($user->firstName,$facUser->firstName);
    }

}