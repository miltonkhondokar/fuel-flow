<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Seed the permissions table.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            // User management
            'user_management',
            'user_list',
            'user_create',
            'user_edit',
            'user_update',
            'user_delete',
            'user_view',

            // Role management
            'role_management',
            'role_list',
            'role_create',
            'role_edit',
            'role_update',
            'role_delete',
            'role_view',

            // Permission management
            'permission_management',
            'permission_list',
            'permission_create',
            'permission_edit',
            'permission_update',
            'permission_delete',
            'permission_view',
            'permission_assign',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission, 'guard_name' => 'web']);
        }
    }
}
