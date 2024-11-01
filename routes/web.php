<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::apiResource('book',BookController::class);
Route::post('/book/{book}/rating',[RatingController::class,'store']);

Route::apiResource('user',UserController::class);
Route::post('user/{user}/book',[BookController::class,'store']);
