<?php

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(User::class)->states('client')->create([
            "firstName" => 'test',
            "lastName" => 'client',
            "password" => bcrypt('client'),
            "email" => 't.client@test.pl',
        ]);

        factory(User::class)->states('admin')->create([
            "firstName" => 'test',
            "lastName" => 'admin',
            "password" => bcrypt('admin'),
            "email" => 't.admin@test.pl',
        ]);
    }
}