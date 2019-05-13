<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Models\User;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

$factory->define(User::class, function (Faker $faker) {
    return [
        'firstName' => $faker->firstName,
        'lastName' => $faker->lastName,
        'email' => $faker->unique()->safeEmail,
        'password' => bcrypt('secret'),
        'loginToken' => Str::random(60),
    ];
});

$factory->state(User::class, 'admin', [
    'role' => \App\Services\UserService::ROLE_ADMIN
]);

$factory->state(User::class, 'client', [
    'role' => \App\Services\UserService::ROLE_CLIENT
]);