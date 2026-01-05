<?php

namespace App\Http\Controllers\AccessManagement\UserManagement;

use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class UserManagementController extends Controller
{
    public function index()
    {
        if (!auth()->user()->can('user_list')) {
            abort(403); // Or redirect with error
        }
        // check_permission('user_list');
        // Fetch users (or any other data)
        $users = User::where('user_status', 1)->orderBy('id', 'desc')->paginate(10);

        // Define breadcrumb dynamically
        $breadcrumb = [
            "page_header" => "Access Management",
            "first_item_name" => "Users",
            "first_item_link" => route('users.index'),
            "second_item_name" => "User List",
            "second_item_link" => route('users.index'),
        ];

        // Pass breadcrumb data to the view
        return view('access-management.user-management.index', compact('users', 'breadcrumb'));
    }


    public function create()
    {
        // $this->authorize('create users');

        // Define breadcrumb dynamically
        $breadcrumb = [
            "page_header" => "Access Management",
            "first_item_name" => "Users",
            "first_item_link" => route('users.index'),
            "second_item_name" => "Create",
            "second_item_link" => route('users.create'),
        ];
        return view('access-management.user-management.create', compact('breadcrumb'));
    }

    public function store(Request $request)
    {
        // Validation rules
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'regex:/^[a-zA-Z.\-\s]+$/'],
            'email' => ['required', 'email', 'unique:users,email'],
            'mobile' => ['required', 'regex:/^(?:\+88|88)?(01[1-9]\d{8})$/'],
            'user_type' => ['required', 'in:1,2,3,4,5,6,7,8'],
            'password' => [
                'required',
                'string',
                'regex:/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[@$!%*?&#])[A-Za-z\d@$!%*?&#]{8,}$/',
            ]
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        DB::beginTransaction();

        try {
            // Create the user
            $user = User::create([
                'uuid' => Str::uuid(),
                'name' => $request->name,
                'email' => $request->email,
                'mobile' => $request->mobile,
                'user_type' => $request->user_type,
                'password' => bcrypt($request->password),
                'user_status' => 1,
            ]);

            // Assign selected role (e.g., Admin or Super Admin)
            $role = Role::where('name', $request->role)->first();
            if ($role) {
                $user->assignRole($role);
            }

            DB::commit();

            Alert::success('Success', 'User Created Successfully')->persistent('OK');
            return redirect()->route('users.index');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error creating User: ' . $e->getMessage());

            Alert::error('Error', 'Failed to create user. Please try again.')->persistent('OK');
            return redirect()->back()->withInput();
        }
    }



    public function show($id)
    {
        abort(403, 'Unauthorized action.');
    }

    public function edit($uuid)
    {
        // $this->authorize('edit users');

        $user = User::where('uuid', $uuid)->firstOrFail();

        // Define breadcrumb dynamically
        $breadcrumb = [
            "page_header" => "Access Management",
            "first_item_name" => "Users",
            "first_item_link" => route('users.index'),
            "second_item_name" => "User Edit",
            "second_item_link" => route('users.edit', ['uuid' => $user->uuid]), // Edit link
        ];


        if (!$user) {
            Alert::error('Error', 'No user found.')->persistent('OK');
            return redirect()->route('users.index');
        }

        return view('access-management.user-management.edit', compact('user', 'breadcrumb'));
    }

    public function update(Request $request, $uuid)
    {
        // $this->authorize('update users');

        // Validation rules
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'regex:/^[a-zA-Z.\-\s]+$/'],
            'email' => ['required', 'email'],
            'mobile' => ['required', 'regex:/^(?:\+88|88)?(01[1-9]\d{8})$/'],
            'user_type' => ['required', 'in:1,2,3,4,5,6,7,8'],
            'user_status' => ['required', 'in:0,1'],
            'password' => [
                'nullable',
                'string',
                'regex:/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[@$!%*?&#])[A-Za-z\d@$!%*?&#]{8,}$/',
            ],
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        DB::beginTransaction();

        try {
            // Find the user
            $user = User::where('uuid', $uuid)->firstOrFail();

            if (!$user) {
                Alert::error('Error', 'No user found.')->persistent('OK');
                return redirect()->route('users.index');
            }

            // Update user information
            $user->name = $request->input('name');
            $user->email = $request->input('email');
            $user->mobile = $request->input('mobile');
            $user->user_type = $request->input('user_type');
            $user->user_status = $request->input('user_status');

            // If a password is provided, hash it and update
            if ($request->filled('password')) {
                $user->password = bcrypt($request->input('password'));
            }

            // Save the updated user
            $user->save();

            DB::commit();

            Alert::success('Success', 'User Updated Successfully')->persistent('OK');
            return redirect()->route('users.index');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error updating User: ' . $e->getMessage());

            Alert::error('Error', 'Failed to update user. Please try again.')->persistent('OK');
            return redirect()->back()->withInput();
        }
    }

    public function destroy($roleId)
    {
        abort(403, 'Unauthorized action.');
    }
}
