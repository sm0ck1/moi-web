<?php

use Illuminate\Support\Facades\Route;

Route::middleware(\App\Http\Middleware\ApiAccessMiddleware::class)->group(function () {

    Route::prefix('topic')->group(function () {
        Route::get('/', [\App\Http\Controllers\ApiController::class, 'getTopics']);
    });

    Route::prefix('post')->group(function () {
        Route::post('/', [\App\Http\Controllers\ApiController::class, 'setPosts']);
    });

    Route::prefix('domain')->group(function () {
        Route::get('/', [\App\Http\Controllers\ApiController::class, 'getDomains']);
        Route::post('/', [\App\Http\Controllers\ApiController::class, 'setDomain']);
    });
});
