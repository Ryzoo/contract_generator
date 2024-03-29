<?php

namespace Tests\Unit\Services;

use App\Core\Models\Database\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;
use Whoops\Exception\ErrorException;
use App\Core\Services\UserService;

class UserServiceTest extends TestCase {
    use RefreshDatabase;

    private UserService $userService;

    public function setUp(): void {
        parent::setUp();
        $this->userService = $this->app->make(UserService::class);
    }

    public function testChangeUserImage(): void {
        $savedUser = factory(User::class)
            ->states('client')
            ->create();
        $uploadedFile = UploadedFile::fake()->image('photo1.jpg');
        Storage::fake('local');

        $newFilePath = $this->userService->changeUserImage($savedUser->id, $uploadedFile);

        Storage::disk('local')
            ->assertExists($newFilePath);
    }

    public function testChangeUserImageThrowExceptionWhenUserNotFound(): void {
        $this->expectException(ModelNotFoundException::class);
        $uploadedFile = UploadedFile::fake()->image('photo1.jpg');
        $this->userService->changeUserImage(-1, $uploadedFile);
    }
}
