<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\PasswordResetController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('register',[AuthController::class,'register']);
Route::post('login',[AuthController::class,'login']);
Route::middleware('auth:sanctum')->group(function () {
    Route::post('logout', [AuthController::class, 'logout']);
    Route::apiResource('user',UserController::class);
    Route::get('user/{user}',[UserController::class,'show']);
    Route::post('reset-email',[PasswordResetController::class,'sendResetLinkEmail']);
});

Route::apiResource('book',BookController::class);
Route::post('/book/{book}/rating',[RatingController::class,'store']);

// Route::apiResource('user',UserController::class);
// Route::post('user/{user}/book',[BookController::class,'store']);