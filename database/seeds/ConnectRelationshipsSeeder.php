<?php

use Illuminate\Database\Seeder;

class ConnectRelationshipsSeeder extends Seeder
{
    public function run()
    {
        $permissions = \jeremykenedy\LaravelRoles\Models\Permission::all();
        $roleAdmin = \jeremykenedy\LaravelRoles\Models\Role
            ::where('name', '=', 'Admin')
            ->first();

        foreach ($permissions as $permission)
            $roleAdmin->attachPermission($permission);

    }
}
