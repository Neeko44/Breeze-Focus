<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\UserDashboardController;
use App\Http\Controllers\MuseumDashboardController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('/user/dashboard', [UserDashboardController::class, 'index'])->name('user.dashboard');
    Route::get('/museum/dashboard', [MuseumDashboardController::class, 'index'])->name('museum.dashboard');
    Route::get('/dashboard', function () {
        return view('dashboard'); // Tambahkan halaman home jika belum ada
    })->name('dashboard');
});

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/manage-roles', [AdminDashboardController::class, 'showManageRoles'])->name('manage.roles');
    Route::put('/admin/update-role/{user}', [AdminDashboardController::class, 'updateRole'])->name('update.role');
    Route::delete('/users/{id}', [AdminDashboardController::class, 'destroy'])->name('delete.user');
});

// Jika menggunakan RoleController
//Route::patch('/role/update/{user}', [RoleController::class, 'updateRole'])->name('role.update');

Route::middleware('auth')->group(function () {
    Route::put('/profile/photo-update', [ProfileController::class, 'updatePhoto'])->name('profile.update.photo');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::post('/logout', function () {
    Auth::logout();
    return redirect('/');
})->name('logout');


require __DIR__.'/auth.php';
