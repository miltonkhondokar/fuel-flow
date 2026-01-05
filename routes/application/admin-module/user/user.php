<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AccessManagement\UserManagement\UserManagementController;

/*
|--------------------------------------------------------------------------
| User Management Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your user management. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::middleware(['auth', 'auth.check'])->group(function () {
    Route::resource('users', UserManagementController::class)->parameters([
        'users' => 'uuid',
    ]);
});

