<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\FinanceController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

// Root: arahkan ke login
Route::get('/', function () {
    return redirect()->route('login.form');
});

// Auth Routes: Login & Register

Route::get('/register', [RegisterController::class, 'showForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

Route::get('/login', [LoginController::class, 'showForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);


// Forgot password atau reset bisa ditambahkan nanti

/*
|--------------------------------------------------------------------------
| Routes untuk user yang sudah login
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Schedule
    Route::resource('schedule', ScheduleController::class)->except(['show']);

    // Finance
    Route::resource('finance', FinanceController::class)->except(['show']);

    // Wishlist
    Route::resource('wishlist', WishlistController::class)->except(['show']);

    // Logout
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
});
