<?php

namespace Tests\Unit\Services;

use App\Core\Models\Database\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;
use Whoops\Exception\ErrorException;
use App\Core\Services\AuthService;

class AuthServiceTest extends TestCase {
    use RefreshDatabase;

    private AuthService $authService;

    public function setUp(): void {
        parent::setUp();
        $this->authService = $this->app->make(AuthService::class);
    }

    public function testLoginUser(): void {
        $credentials = [
            'password' => Hash::make('client'),
            'email' => 't.client@test.pl',
        ];

        $notSavedUser = factory(User::class)->create($credentials);
        $loggedUser = $this->authService->loginUser([
            'password' => 'client',
            'email' => 't.client@test.pl',
        ]);

        $this->assertNotEquals($notSavedUser->loginToken, $loggedUser->loginToken);
    }

    public function testLoginUserThrowExceptionWhenBadEmail(): void {
        $this->expectException(ErrorException::class);

        $credentials = [
            'password' => Hash::make('test'),
            'email' => 't.client@test.pl',
        ];

        $this->authService->loginUser($credentials);
    }

    public function testLoginUserThrowExceptionWhenBadPassword(): void {
        $this->expectException(ErrorException::class);

        $credentials = [
            'password' => Hash::make('client'),
            'email' => 't.client@test.pl',
        ];

        factory(User::class)->create($credentials);

        $this->authService->loginUser([
            'password' => 'inne',
            'email' => 't.client@test.pl',
        ]);
    }
}
