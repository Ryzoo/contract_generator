<?php

namespace App\Services;

use App\Models\User;

class UserService
{
    public const ROLE_CLIENT = 0;
    public const ROLE_ADMIN = 1;

    public function addUser(string $firstName, string $lastName, string $email, string $password, int $role = self::ROLE_CLIENT):?User {
        return null;
    }
}
