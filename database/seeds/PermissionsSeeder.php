<?php

use Illuminate\Database\Seeder;
use jeremykenedy\LaravelRoles\Models\Permission;

class PermissionsSeeder extends Seeder {

    public function run() {
        $permissionItems = [
            [
                'name' => 'Manage users',
                'slug' => 'manage.users',
                'description' => 'Can manage all users',
                'model' => "App\Models\Database\User",
            ],
            [
                'name' => 'Manage roles',
                'slug' => 'manage.roles',
                'description' => 'Can manage all roles',
            ],
            [
                'name' => 'Manage contracts',
                'slug' => 'manage.contracts',
                'description' => 'Can manage all contracts',
            ],
            [
                'name' => 'Manage categories',
                'slug' => 'manage.categories',
                'description' => 'Can manage all categories',
            ],
          [
            'name' => 'Manage variable library',
            'slug' => 'manage.library.attributes',
            'description' => 'Can manage all variables in library',
          ]
        ];

        foreach ($permissionItems as $permissionItem) {
            $newPermissionItem = Permission
                ::where('slug', '=', $permissionItem['slug'])
                ->first();

            if (!isset($newPermissionItem)) {
                Permission::create([
                    'name' => $permissionItem['name'],
                    'slug' => $permissionItem['slug'],
                    'description' => $permissionItem['description'],
                    'model' => $permissionItem['model'] ?? NULL,
                ]);
            }
        }
    }
}
