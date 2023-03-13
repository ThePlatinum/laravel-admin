<?php

use App\Http\Controllers\Admin\Auth\AdminAuthSessionController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest:admin')->group(function () {

  Route::get('login', [AdminAuthSessionController::class, 'showLoginForm'])->name('admin.login');

  Route::post('login', [AdminAuthSessionController::class, 'login']);

  // Upcoming 

  // Route::get('forgot-password', [AdminPasswordResetLinkController::class, 'create'])->name('admin.password.request');

  // Route::post('forgot-password', [AdminPasswordResetLinkController::class, 'store'])->name('admin.password.email');

  // Route::get('reset-password/{token}', [AdminNewPasswordController::class, 'create'])->name('admin.password.reset');

  // Route::post('reset-password', [AdminNewPasswordController::class, 'store'])->name('admin.password.store');
});

Route::middleware('auth:admin')->group(function () {
  Route::post('logout', [AdminAuthSessionController::class, 'logout'])->name('admin.logout');
});

Route::get('/dashboard', function () {
  return view('admin.dashboard');
})->middleware(['auth:admin'])->name('admin.dashboard');