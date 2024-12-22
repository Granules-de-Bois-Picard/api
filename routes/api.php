<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'auth'], function () {
    Route::post('login', [AuthController::class, 'login']);
    Route::post('register', [AuthController::class, 'register']);

    Route::group(['middleware' => 'auth:sanctum'], function () {
        Route::get('check', [AuthController::class, 'check']);
        Route::post('logout', [AuthController::class, 'logout']);
    });


});

Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::group(['prefix' => 'users'], function () {
        Route::get('/', [UserController::class, 'index']);
        Route::get('{id}', [UserController::class, 'show'])->where('id', '[0-9a-fA-F]{24}');
    });
});

