<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\MovieController;
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
// Routes protégées par Sanctum
Route::resource('movies', MovieController::class)->middleware('auth:sanctum');
Route::post('logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

Route::post('verifyToken', [AuthController::class, 'verifyToken'])->middleware('auth:sanctum');

// Routes publiques
Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);
