<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AccessManagement\Permission\PermissionController;
use App\Http\Controllers\AccessManagement\Permission\Role\RolePermissionController;
use App\Http\Controllers\AccessManagement\Permission\Role\UserRoleController;

/*
|--------------------------------------------------------------------------
| Permission Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your permissions. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware(['auth', 'auth.check'])->group(function () {
    Route::resource('permissions', PermissionController::class);

    Route::get('permissions-list/{roleId}', [RolePermissionController::class, 'getPermissionList'])->name('permissions-list');
    Route::post('role-permissions/{roleId}', [RolePermissionController::class, 'assignPermissions'])->name('role-permissions');

    Route::resource('user-role', UserRoleController::class)->parameters([
        'user-role' => 'user',
    ]);
});
