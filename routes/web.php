<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\FinanceController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\ProfileController;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Root: arahkan ke login (karena ini aplikasi personal)
Route::get('/', function () {
    return redirect()->route('login');
});


/*
|--------------------------------------------------------------------------
| Authenticated Routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {

    // DASHBOARD
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    // SCHEDULE
    Route::resource('schedule', ScheduleController::class)
        ->except(['show']);

    // FINANCE
    Route::resource('finance', FinanceController::class)
        ->except(['show']);

    // WISHLIST
    Route::resource('wishlist', WishlistController::class)
        ->except(['show']);

    // LOGOUT (opsional, kalau mau eksplisit)
    Route::post('/logout', function () {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();

        return redirect()->route('login');
    })->name('logout');
});


/*
|--------------------------------------------------------------------------
| Auth Routes (Login, Register, Forgot Password)
|--------------------------------------------------------------------------
*/

require __DIR__.'/auth.php';
