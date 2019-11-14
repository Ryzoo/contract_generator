<?php

namespace Tests\Unit\Services;

use App\Core\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;
use Whoops\Exception\ErrorException;

class UserServiceTest extends TestCase {
    use RefreshDatabase;

    /***
     * @var \App\Core\Services\UserService
     */
    private $userService;

    public function setUp(): void {
        parent::setUp();
        $this->userService = $this->app->make('App\Core\Services\UserService');
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
        $this->expectException(ModelNotFoundException::class);
        $uploadedFile = UploadedFile::fake()->image('photo1.jpg');
        $this->userService->changeUserImage(-1, $uploadedFile);
    }
}
