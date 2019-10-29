<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    public function run()
    {
        $roleItems = [
            [
                'name'        => 'Admin',
                'slug'        => 'admin',
                'description' => 'Admin Role',
                'level'       => 5,
            ],
            [
                'name'        => 'User',
                'slug'        => 'user',
                'description' => 'User Role',
                'level'       => 1,
            ],
        ];

        foreach ($roleItems as $role) {
            $newRoleItem = \jeremykenedy\LaravelRoles\Models\Role
                ::where('slug', '=', $role['slug'])
                ->first();

            if (!isset($newRoleItem))
                \jeremykenedy\LaravelRoles\Models\Role::create([
                    'name'          => $role['name'],
                    'slug'          => $role['slug'],
                    'description'   => $role['description'],
                    'level'         => $role['level'],
                ]);

        }
    }
}
