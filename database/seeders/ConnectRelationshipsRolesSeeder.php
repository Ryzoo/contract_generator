<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use jeremykenedy\LaravelRoles\Models\Permission;
use jeremykenedy\LaravelRoles\Models\Role;

class ConnectRelationshipsRolesSeeder extends Seeder
{
    public function run()
    {
        $permissions = Permission::all();
        $roleAdmin = Role::where('slug', '=', 'admin')
            ->first();

        foreach ($permissions as $permission)
            $roleAdmin->attachPermission($permission);
    }
}
