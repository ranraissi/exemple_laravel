<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {

    Route::post('/logout', [AuthController::class, 'logout']);

    // Profile (own data)
    Route::get('/profile', [ProfileController::class, 'show']);
    Route::put('/profile', [ProfileController::class, 'update']);

    // Users CRUD (permission-based)
    Route::get('/users', [UserController::class, 'index'])->middleware('permission:view users');
    Route::post('/users', [UserController::class, 'store'])->middleware('permission:create users');
    Route::get('/users/{id}', [UserController::class, 'show'])->middleware('permission:view users');
    Route::put('/users/{id}', [UserController::class, 'update'])->middleware('permission:update users');
    Route::delete('/users/{id}', [UserController::class, 'destroy'])->middleware('permission:delete users');

    // Assign role (admin only)
    Route::post('/users/{id}/assign-role', [UserController::class, 'assignRole'])->middleware('permission:assign roles');

});
