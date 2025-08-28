<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TagController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Controllers\CategoryController;


Route::get('/register', [AuthController::class, 'showRegister'])->name('register.form');
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::get('/login', [AuthController::class, 'showLogin'])->name('login.form');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {
    Route::resource('categories', CategoryController::class)->middleware('permission:manage_categories');
    Route::resource('tags', TagController::class)->middleware(['permission:manage_tags']);
    Route::resource('users', UserController::class)->middleware('permission:manage_users'); 

}); 

Route::middleware(['role:super-admin'])->group(function () {
    Route::get('/users/make-admin', [UserController::class, 'index'])->name('users.index');
    Route::put('/users/{user}/make-admin', [UserController::class, 'makeAdmin'])->name('users.makeAdmin');
});

