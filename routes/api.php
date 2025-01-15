<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SlideController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\StatusController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'status'], function () {
    Route::get('website', [StatusController::class, 'checkWebsite']);
    Route::get('api', [StatusController::class, 'checkApi']);
    Route::get('backoffice', [StatusController::class, 'checkBackoffice']);
});

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

Route::group(['prefix' => 'articles'], function () {
    Route::get('/', [ArticleController::class, 'index']);
    Route::get('/last', [ArticleController::class, 'lastArticle']);
    Route::get('{identifier}', [ArticleController::class, 'show'])->where('identifier', '[0-9a-fA-F\-]{36}|[a-zA-Z0-9\-]+');

    Route::group(['middleware' => 'auth:sanctum'], function () {
        Route::post('/', [ArticleController::class, 'store']);
        Route::put('{id}', [ArticleController::class, 'update'])->where('id', '[0-9a-fA-F\-]{36}');
        Route::delete('{id}', [ArticleController::class, 'destroy'])->where('id', '[0-9a-fA-F\-]{36}');
    });
});

Route::group(['prefix' => 'slides'], function () {
    Route::get('/', [SlideController::class, 'index']);
    Route::get('{id}', [SlideController::class, 'show'])->where('id', '[0-9a-fA-F\-]{36}');

    Route::group(['middleware' => 'auth:sanctum'], function () {
        Route::post('/', [SlideController::class, 'store']);
        Route::put('{id}', [SlideController::class, 'update'])->where('id', '[0-9a-fA-F\-]{36}');
        Route::delete('{id}', [SlideController::class, 'destroy'])->where('id', '[0-9a-fA-F\-]{36}');
    });
});


