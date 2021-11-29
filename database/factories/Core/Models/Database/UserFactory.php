<?php

namespace Database\Factories\Core\Models\Database;

use App\Core\Models\Database\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use jeremykenedy\LaravelRoles\Models\Role;


class UserFactory extends Factory {
    protected $model = User::class;

    public function definition() : array
    {
        return [
            'firstName' => $this->faker->firstName,
            'lastName' => $this->faker->lastName,
            'email' => $this->faker->unique()->safeEmail,
            'password' => Hash::make('secret'),
            'loginToken' => Str::random(80),
        ];
    }

    public function asAdmin() : Factory
    {
        return $this->state(function () {
            return [
                'firstName' => 'test',
                'lastName' => 'admin',
                'password' => Hash::make('admin1'),
                'email' => 't.admin@test.pl',
            ];
        });
    }

    public function asClient() : Factory
    {
        return $this->state(function () {
            return [
                'firstName' => 'test',
                'lastName' => 'client',
                'password' => Hash::make('client'),
                'email' => 't.client@test.pl',
            ];
        });
    }

    public function configure() : Factory
    {
        return $this->afterCreating(function (User $user) {
            if($user->lastName === 'admin'){
                $role = Role::where('slug', 'admin')->first();
                $user->attachRole($role);
            }else{
                $role = Role::where('slug', 'client')->first();
                $user->attachRole($role);
            }
        });
    }
}



