<?php

use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $permissionItems = [
            [
                'name' => "Create users",
                'slug' => "create.users",
                'description' => "create users"
            ],
            [
                'name' => "Update users",
                'slug' => "update.users",
                'description' => "update users"
            ]
        ];

        foreach ($permissionItems as $permissionItem) {
            $newPermissionItem = \jeremykenedy\LaravelRoles\Models\Permission
                ::where('slug', '=', $permissionItem['slug'])
                ->first();

            if (!isset($newPermissionItem)) {
                \jeremykenedy\LaravelRoles\Models\Permission::create([
                    'name' => $permissionItem['name'],
                    'slug' => $permissionItem['slug'],
                    'description' => $permissionItem['description'],
                    'model' => isset($permissionItem['model']) ? $permissionItem['model'] : null,
                ]);
            }
        }
    }
}
