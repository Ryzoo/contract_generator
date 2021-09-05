<?php

namespace Database\Seeders;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder {

  public function run() {
    Model::unguard();

    $this->call(PermissionsSeeder::class);
    $this->call(RolesSeeder::class);
    $this->call(ConnectRelationshipsRolesSeeder::class);
    $this->call(UserSeeder::class);
    $this->call(CategorySeeder::class);
    $this->call(DraftsSeeder::class);

    Model::reguard();
  }
}
