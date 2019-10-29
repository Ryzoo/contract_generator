<?php

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
        factory(\App\Core\Models\User::class)->states('client')->create([
            "firstName" => 'test',
            "lastName" => 'client',
            "password" => \Illuminate\Support\Facades\Hash::make('client'),
            "email" => 't.client@test.pl',
        ]);

        factory(\App\Core\Models\User::class)->states('admin')->create([
            "firstName" => 'test',
            "lastName" => 'admin',
            "password" => \Illuminate\Support\Facades\Hash::make('admin1'),
            "email" => 't.admin@test.pl',
        ]);
    }
}
