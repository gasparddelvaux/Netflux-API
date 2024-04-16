<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DirectorController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
/**
* Routes protégées par Sanctum
*/

// Films
Route::resource('movies', MovieController::class)->middleware('auth:sanctum');

// Réalisateurs
Route::resource('directors', DirectorController::class)->middleware('auth:sanctum');
Route::get('directors-list', [DirectorController::class, 'list'])->middleware('auth:sanctum');

// Auth
Route::post('logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
Route::post('verifyToken', [AuthController::class, 'verifyToken'])->middleware('auth:sanctum');

// Utilisateurs
Route::get('user-info', [UserController::class, 'info'])->middleware('auth:sanctum');

// Admin
Route::group(['prefix' => 'admin', 'middleware' => ['auth:sanctum', 'checkrole']], function () {
    Route::get('users', [UserController::class, 'index']);
    Route::get('userInfo/{id}', [UserController::class, 'userInfo']);
    Route::put('users/{id}', [UserController::class, 'update']);
    Route::get('movies', [MovieController::class, 'indexAdmin']);
});

/**
* Routes publiques
*/

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);
