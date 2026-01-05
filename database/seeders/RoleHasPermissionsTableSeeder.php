<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleHasPermissionsTableSeeder extends Seeder
{
    /**
     * Seed the role_has_permissions table.
     *
     * @return void
     */
    public function run()
    {
        // Defining the permissions
        $rolePermissions = [
            'Admin' => Permission::pluck('name')->toArray(),
        ];

        // Loop through roles and assign corresponding permissions
        foreach ($rolePermissions as $roleName => $permissions) {
            $role = Role::firstOrCreate(['name' => $roleName]); // Make sure the role exists or create it
            $role->syncPermissions($permissions); // Sync permissions to the role
        }
    }
}
