<?php

namespace Tests\Unit\Services;

use App\Enums\UserRole;
use App\Mail\ResetPassword;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Tests\TestCase;
use Whoops\Exception\ErrorException;

class AuthServiceTest extends TestCase {
    use RefreshDatabase;

    /***
     * @var \App\Services\AuthService
     */
    private $authService;

    public function setUp(): void {
        parent::setUp();
        $this->authService = $this->app->make('App\Services\AuthService');
    }

    public function testRegisterUser() {
        $notSavedUser = factory(User::class)
            ->make();

        $notSavedUser['regulationsAccept'] = "test";
        $notSavedUser['rodoAccept'] = "test";

        $savedUser = $this->authService->registerUser($notSavedUser, UserRole::CLIENT);

        $this->assertTrue($savedUser->id > 0);
        $this->assertEquals(UserRole::CLIENT, $savedUser->role);
    }

    public function testLoginUser() {
        $email = 't.client@test.pl';
        $password = 'client';

        $notSavedUser = factory(User::class)->create([
            "password" => $password,
            "email" => $email,
        ]);

        $logedUser = $this->authService->loginUser($email,$password);

        $this->assertNotEquals($notSavedUser->loginToken, $logedUser->loginToken);
    }

    public function testLoginUserThrowExceptionWhenBadEmail() {
        $this->expectException(ErrorException::class);

        $email = 'test';
        $password = 'client';

        $this->authService->loginUser($email,$password);
    }

    public function testLoginUserThrowExceptionWhenBadPassword() {
        $this->expectException(ErrorException::class);

        $email = 't.client@test.pl';
        $password = 'client';

        factory(User::class)->create([
            "password" => $password,
            "email" => $email,
        ]);

        $this->authService->loginUser($email,"test");
    }

    public function testAuthorizeLogedUser() {
        $email = 't.client@test.pl';
        $password = 'client';

        factory(User::class)->create([
            "password" => $password,
            "email" => $email,
        ]);

        $logedUser = $this->authService->loginUser($email,$password);

        $authorizedUser = $this->authService->authorizeLogedUser($logedUser->loginToken);

        $this->assertInstanceOf(User::class, $authorizedUser);
    }

    public function testAuthorizeLogedUserThrowNoAccessException() {
        $this->expectException(ErrorException::class);
        $this->authService->authorizeLogedUser("test");
    }

    public function testSendResetPasswordToken() {
        $email = 't.client@test.pl';
        $password = 'client';
        Mail::fake();

        factory(User::class)->create([
            "password" => $password,
            "email" => $email,
        ]);

        $resetToken = $this->authService->sendResetPasswordToken($email);

        $this->assertEquals(60, Str::length($resetToken));
        Mail::assertSent(ResetPassword::class);
    }

    public function testSendResetPasswordTokenThrowExceptionWhenNotFoundUser() {
        $this->expectException(ErrorException::class);

        $this->authService->sendResetPasswordToken("bad@email.com");
    }

    public function testResetUserPassword() {
        $email = 't.client@test.pl';
        $password = 'client';
        $newPassword = 'fajneHaslo';

        factory(User::class)->create([
            "password" => $password,
            "email" => $email,
        ]);

        $resetToken = $this->authService->sendResetPasswordToken($email);

        $this->authService->resetUserPassword($resetToken, $newPassword);

        $logedUser = $this->authService->loginUser($email,$newPassword);
        $this->assertInstanceOf(User::class, $logedUser);
    }

    public function testResetUserPasswordThrowBadTokenException() {
        $this->expectException(ErrorException::class);

        $this->authService->resetUserPassword("test", "test");
    }
}
