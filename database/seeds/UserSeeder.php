<?php

use App\Core\Models\Database\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        factory(User::class)->states('client')->create([
            'firstName' => 'test',
            'lastName' => 'client',
            'password' => Hash::make('client'),
            'email' => 't.client@test.pl',
        ]);

        factory(User::class)->states('admin')->create([
            'firstName' => 'test',
            'lastName' => 'admin',
            'password' => Hash::make('admin1'),
            'email' => 't.admin@test.pl',
        ]);
    }
}
