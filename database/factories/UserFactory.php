<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Core\Models\User;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

$factory->define(User::class, function (Faker $faker) {
    return [
        'firstName' => $faker->firstName,
        'lastName' => $faker->lastName,
        'email' => $faker->unique()->safeEmail,
        'password' => Hash::make('secret'),
        'loginToken' => Str::random(80),
    ];
});

$factory->state(User::class, 'admin',[]);
$factory->state(User::class, 'client', []);

$factory->afterCreatingState(User::class, 'admin', function ($user, $faker) {
    $role = \jeremykenedy\LaravelRoles\Models\Role::where('slug', '=', 'admin')->first();
    $user->attachRole($role);
});

$factory->afterCreatingState(User::class, 'client', function ($user, $faker) {
    $role = \jeremykenedy\LaravelRoles\Models\Role::where('slug', '=', 'user')->first();
    $user->attachRole($role);
});


