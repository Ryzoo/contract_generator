<?php

namespace Tests\Unit\Services;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;
use Whoops\Exception\ErrorException;

class UserServiceTest extends TestCase {
    use RefreshDatabase;

    /***
     * @var \App\Services\UserService
     */
    private $userService;

    /***
     * @var \App\Repository\UserRepository
     */
    private $userRepository;

    public function setUp(): void {
        parent::setUp();
        $this->userService = $this->app->make('App\Services\UserService');
        $this->userRepository = $this->app->make('App\Repository\UserRepository');
    }

    public function testAddUser() {
        $notSavedUser = factory(User::class)
            ->states('client')
            ->make();

        $notSavedUser['rePassword'] = "test";

        $savedUser = $this->userService->addUser($notSavedUser);

        $this->assertTrue($savedUser->id > 0);
    }

    public function testUpdateUser() {
        $savedUser = factory(User::class)
            ->states('client')
            ->create();

        $savedUser->firstName = "Adam";
        $savedUser->lastName = "Kowalski";

        $savedUser = $this->userService->updateUser($savedUser);

        $this->assertEquals("Adam", $savedUser->firstName);
        $this->assertEquals("Kowalski", $savedUser->lastName);
    }

    public function testUpdateUserThrowExceptionWhenUserNotFound() {
        $this->expectException(ErrorException::class);
        $savedUser = factory(User::class)
            ->states('client')
            ->make();

        $savedUser->id = -1;
        $this->userService->updateUser($savedUser);
    }

    public function testRemoveUser() {
        $savedUser = factory(User::class)
            ->states('client')
            ->create();

        $this->userService->removeUser($savedUser->id);

        $this->assertDatabaseHas('users', [
            'id' => $savedUser->id
        ]);
    }

    public function testRemoveUserReturnFalseWhenNotFoundUser() {
        $isUserRemoved = $this->userService->removeUser(-1);
        $this->assertFalse($isUserRemoved);
    }

    public function testGetUserList() {
        factory(User::class)
            ->states('client')
            ->create();

        $list = $this->userRepository->getUserList();

        $this->assertInstanceOf(Collection::class, $list);
        $this->assertEquals(1, $list->count());
    }

    public function testChangeUserImage() {
        $savedUser = factory(User::class)
            ->states('client')
            ->create();
        $uploadedFile = UploadedFile::fake()->image('photo1.jpg');
        Storage::fake('local');

        $newFilePath = $this->userService->changeUserImage($savedUser->id, $uploadedFile);

        Storage::disk('local')
            ->assertExists($newFilePath);
    }

    public function testChangeUserImageThrowExceptionWhenUserNotFound() {
        $this->expectException(ErrorException::class);
        $uploadedFile = UploadedFile::fake()->image('photo1.jpg');
        $this->userService->changeUserImage(-1, $uploadedFile);
    }
}
