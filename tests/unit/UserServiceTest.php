<?php

use App\Enums\UserRole;
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

    // tests
    public function testAddClientUser() {
        $userModel = new User();
        $userModel->fill([
            "firstName" => "Adam",
            "lastName" => "Nowak",
            "email" => "a.nowak@gmail.com",
            "password" => bcrypt("fajnehaslo"),
            "role" => UserRole::CLIENT
        ]);

        $user = $this->userService->addUser($userModel);

        $this->assertNotNull($user);
        $this->assertIsObject($user);
        $this->assertTrue(isset($user->id));
        $this->assertTrue(isset($user->role));
        $this->assertEquals(UserRole::CLIENT,$user->role);
    }

    public function testAddAdminUser() {
        $userModel = new User();
        $userModel->fill([
            "firstName" => "Adam",
            "lastName" => "Nowak",
            "email" => "a.nowak@gmail.com",
            "password" => bcrypt("fajnehaslo"),
            "role" => UserRole::ADMIN
        ]);

        $user = $this->userService->addUser($userModel);

        $this->assertNotNull($user);
        $this->assertIsObject($user);
        $this->assertTrue(isset($user->id));
        $this->assertTrue(isset($user->role));
        $this->assertEquals(UserRole::ADMIN,$user->role);
    }

    public function testGetUserByEmail() {
        $user = User::getByEmail("t.client@test.pl");

        $this->assertNotNull($user);
        $this->assertIsObject($user);
        $this->assertTrue(isset($user->id));
        $this->assertTrue(isset($user->role));
        $this->assertEquals(UserRole::CLIENT,$user->role);
    }

    public function testGetUserById() {
        $facUser = factory(User::class)->states('client')->create();

        $user = User::getById($facUser->id);

        $this->assertNotNull($user);
        $this->assertIsObject($user);
        $this->assertTrue(isset($user->id));
        $this->assertTrue(isset($user->role));
        $this->assertEquals(UserRole::CLIENT,$user->role);
    }

    public function testRemoveUser() {
        $facUser = factory(User::class)
            ->states('client')
            ->create();

        $this->assertTrue($this->userService->removeUser($facUser->id));
        $this->assertTrue(User::getById($facUser->id) === null);
    }

    public function testUpdateUser() {
        $facUser = factory(User::class)
            ->states('client')
            ->create();

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
        $this->assertEquals(UserRole::CLIENT,$user->role);
        $this->assertEquals($user->firstName,$facUser->firstName);
    }

}