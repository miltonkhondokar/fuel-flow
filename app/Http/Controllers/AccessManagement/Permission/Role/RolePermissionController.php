<?php

namespace App\Http\Controllers\AccessManagement\Permission\Role;

use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\DB;

class RolePermissionController extends Controller
{
    public function getPermissionList($roleId)
    {
        // $this->authorize('permission_list');

        try {
            $permissions = Permission::get();
            $role = Role::findOrFail($roleId);
            $rolePermissions = DB::table('role_has_permissions')
                ->where('role_id', $role->id)
                ->pluck('permission_id', 'permission_id')
                ->all();

            // Define breadcrumb for the page
            $breadcrumb = [
                "page_header" => "Access Management",
                "first_item_name" => "Roles",
                "first_item_link" => route('roles.index'),
                "second_item_name" => "Role List",
                "second_item_link" => route('roles.index'),
            ];

                return view('access-management.permission.role-permission.assign_permissions', [
                'role' => $role,
                'permissions' => $permissions,
                'rolePermissions' => $rolePermissions,
                'breadcrumb' => $breadcrumb,
            ]);
        } catch (\Exception $e) {
            Log::error('Error retrieving permissions: ' . $e->getMessage());
            Alert::error('Error', 'Error retrieving permissions. Please try again.')->persistent('OK');
            return redirect()->back();
        }
    }

    public function assignPermissions(Request $request, $roleId)
    {
        $request->validate([
            'permissions' => 'required|array'
        ]);
    
        try {
            $role = Role::findOrFail($roleId);
    
            // Reset cache first
            app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();
    
            // Sync permissions
            $role->syncPermissions($request->input('permissions'));
    
            Alert::success('Success', 'Permissions added to role')->persistent('OK');
            return redirect()->back();
        } catch (\Exception $e) {
            Log::error('Error assigning permissions: ' . $e->getMessage());
            Alert::error('Error', 'Failed to assign permissions. Please try again.')->persistent('OK');
            return redirect()->back();
        }
    }
    
}
