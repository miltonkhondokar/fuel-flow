<?php

namespace App\Http\Controllers\AccessManagement\Role;

use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use RealRashid\SweetAlert\Facades\Alert;

class RoleController extends Controller
{
    public function index()
    {
        // $this->authorize('role_list');

        // Define breadcrumb dynamically
        $breadcrumb = [
            "page_header" => "Access Management",
            "first_item_name" => "Roles",
            "first_item_link" => route('roles.index'),
            "second_item_name" => "Role List",
            "second_item_link" => route('roles.index')
        ];

        $roles = Role::paginate(10);
        return view('access-management.role.index', compact('roles', 'breadcrumb'));
    }

    public function create()
    {
        // $this->authorize('role_create');

        // Define breadcrumb dynamically
        $breadcrumb = [
            "page_header" => "Access Management",
            "first_item_name" => "Roles",
            "first_item_link" => route('roles.index'),
            "second_item_name" => "Create",
            "second_item_link" => route('roles.create')
        ];

        return view('access-management.role.create', compact('breadcrumb'));
    }

    public function store(Request $request)
    {
        // $this->authorize('role_store');

        $request->validate([
            'name' => [
                'required',
                'string',
                'unique:roles,name'
            ]
        ]);

        try {
            Role::create([
                'name' => $request->name
            ]);

            Alert::success('Success', 'Role Created Successfully')->persistent('OK');
            return redirect()->route('roles.index');
        } catch (\Exception $e) {
            Log::error('Error creating Role: ' . $e->getMessage());

            Alert::error('Error', 'Failed to create role. Please try again.')->persistent('OK');
            return redirect()->back();
        }
    }

    public function show($id)
    {
        // if (!auth()->user()->can('MCC List')) {
            abort(403, 'Unauthorized action.');
        // }
    }

    public function edit(Role $role)
    {
        // $this->authorize('role_edit');

        // Define breadcrumb dynamically
        $breadcrumb = [
            "page_header" => "Access Management",
            "first_item_name" => "Roles",
            "first_item_link" => route('roles.index'),
            "second_item_name" => "Edit",
            "second_item_link" => route('roles.edit', $role->id)
        ];
        return view('access-management.role.edit', compact('role', 'breadcrumb'));
    }

    public function update(Request $request, Role $role)
    {
        // $this->authorize('role_update');

        $request->validate([
            'name' => [
                'required',
                'string',
                'unique:roles,name,' . $role->id
            ]
        ]);

        try {

            $role->update([
                'name' => $request->name
            ]);

            Alert::success('Success', 'Role Updated Successfully')->persistent('OK');
            return redirect()->route('roles.index');
        } catch (\Exception $e) {
            Log::error('Error updating role: ' . $e->getMessage());
            Alert::error('Error', 'Failed to update role. Please try again.')->persistent('OK');
            return redirect()->back();
        }
    }

    public function destroy($roleId)
    {
        abort(403, 'Unauthorized action.');
        $this->authorize('role_delete');
        try {

            $role = Role::findOrFail($roleId);

            $role->delete();

            Alert::success('Success', 'Role Deleted Successfully')->persistent('OK');
            return redirect()->route('roles.index');
        } catch (\Exception $e) {
            Log::error('Error deleting role: ' . $e->getMessage());

            Alert::error('Error', 'Failed to delete role. Please try again.')->persistent('OK');
            return redirect()->back();
        }
    }
}
