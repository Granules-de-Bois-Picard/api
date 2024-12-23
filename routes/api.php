<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\RoleController;
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
        Route::get('{id}', [UserController::class, 'show'])->where('id', '[0-9a-fA-F\-]{36}');
        Route::post('/', [UserController::class, 'store']);
        Route::put('{id}', [UserController::class, 'update'])->where('id', '[0-9a-fA-F\-]{36}');
        Route::put('{id}/change-password', [UserController::class, 'changePassword'])->where('id', '[0-9a-fA-F\-]{36}');
        Route::delete('{id}', [UserController::class, 'destroy'])->where('id', '[0-9a-fA-F\-]{36}');
    });

    Route::group(['prefix' => 'roles'], function () {
        Route::get('/', [RoleController::class, 'index']);
        Route::get('{id}', [RoleController::class, 'show'])->whereNumber('id');
        Route::post('/', [RoleController::class, 'store']);
        Route::put('{id}', [RoleController::class, 'update'])->whereNumber('id');
        Route::delete('{id}', [RoleController::class, 'destroy'])->whereNumber('id');
    });
});

