<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\CustomAuthController;
use App\Http\Controllers\Command\OptimizeController;
use App\Http\Controllers\UserDashboardController;
use App\Services\RouteService;
use Illuminate\Support\Facades\App;

Route::get('/', function () {
    return Auth::check()
        ? redirect()->to(route('dashboard'))
        : redirect()->route('login');
});

Route::middleware('guest')->group(function () {
    Route::get('login', [CustomAuthController::class, 'showLoginForm'])->name('login');
    Route::post('login', [CustomAuthController::class, 'login'])->middleware('throttle:5,1');
});

Route::middleware(['auth', 'auth.check'])->group(function () {

    Route::get('/', [UserDashboardController::class, 'index'])->name('/');

    // Your existing routes
    Route::post('logout', [CustomAuthController::class, 'logout'])->name('logout');

    Route::get('optimize-clear', [OptimizeController::class, 'clear'])->name('optimize-clear');
});
