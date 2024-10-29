<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JWTAuthController;

Route::group(['prefix' => 'auth'], function ($router) {
    Route::post('register', [JWTAuthController::class, 'register']);
    Route::post('login', [JWTAuthController::class, 'login']);
});

Route::middleware(['auth:api'])->group(function () {
    Route::get('me', [JWTAuthController::class, 'getUser']);
    Route::post('refresh', [JWTAuthController::class, 'refresh']);
    Route::post('logout', [JWTAuthController::class, 'logout']);
});
