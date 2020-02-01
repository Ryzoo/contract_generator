<?php

use Illuminate\Database\Seeder;
use jeremykenedy\LaravelRoles\Models\Role;

class RolesSeeder extends Seeder
{
    public function run()
    {
        $roleItems = [
            [
                'name'        => 'Administrator',
                'slug'        => 'admin',
                'description' => 'Role with all permission',
                'level'       => 10,
            ],
            [
                'name'        => 'Client',
                'slug'        => 'client',
                'description' => 'Basic role in application for new users',
                'level'       => 1,
            ],
        ];

        foreach ($roleItems as $role) {
            $newRoleItem = Role::where('slug', '=', $role['slug'])
                ->first();

            if (!isset($newRoleItem))
                Role::create([
                    'name'          => $role['name'],
                    'slug'          => $role['slug'],
                    'description'   => $role['description'],
                    'level'         => $role['level'],
                ]);

        }
    }
}
