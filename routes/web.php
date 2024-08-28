<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserManagement;
use App\Http\Controllers\MessageController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('guest', function () {
    return view('guestview.pages.dashboard');
})->name('guest');

Route::get('guestcontact', function () {
    return view('guestview.pages.contact');
})->name('guestcontact');

Route::get('/dashboard', function () {
    return view('adminview.pages.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/contact', function () {
    return view('adminview.pages.contact');
})->middleware(['auth', 'verified'])->name('contact');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/user-management', [UserManagement::class, 'userManagement'])->name('user.management');
    Route::get('/user/edit/{id}', [UserManagement::class, 'singleUserManagement']);
    Route::post('/user-management', [UserManagement::class, 'destroy'])->name('user.destroy');
    Route::get('/admin/user/{id}/edit', [UserManagement::class, 'singleUserManagement'])->name('user.edit');
    Route::patch('/admin/user/{id}/update', [UserManagement::class, 'updateUser'])->name('user.update');
    Route::post('/messages', [MessageController::class, 'store'])->name('messages.store');
    Route::get('/messages', [MessageController::class, 'index'])->name('messages.index');
});

require __DIR__.'/auth.php';
