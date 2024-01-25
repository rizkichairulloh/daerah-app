<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\BlogController;
use App\Http\Controllers\API\KelompokController;
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

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/blogs', [BlogController::class, 'index']);
    Route::post('/blogs', [BlogController::class, 'store']);
    Route::delete('/blogs/{id}', [BlogController::class, 'destroy']);
    Route::post('/blogs/{id}', [BlogController::class, 'update']);
    Route::get('/blogs/{id}', [BlogController::class, 'show']);
});

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/kelompok', [KelompokController::class, 'index']);
    Route::post('/kelompok', [KelompokController::class, 'store']);
    Route::delete('/kelompok/{id}', [KelompokController::class, 'destroy']);
    Route::post('/kelompok/{id}', [KelompokController::class, 'update']);
    Route::get('/kelompok/{id}', [KelompokController::class, 'show']);
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
