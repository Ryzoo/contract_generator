<?php

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $this->call(PermissionsSeeder::class);
        $this->call(RolesSeeder::class);
        $this->call(ConnectRelationshipsRolesSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(CategorySeeder::class);

        Model::reguard();
    }
}
