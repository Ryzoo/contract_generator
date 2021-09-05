<?php

namespace Database\Seeders;


use App\Core\Models\Database\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        User::factory()->asAdmin()->create();
        User::factory()->asClient()->create();
    }
}
