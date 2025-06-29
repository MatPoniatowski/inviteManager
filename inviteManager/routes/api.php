<?php

use App\UI\Http\Controllers\Api\EventController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\UI\Http\Controllers\AuthController;

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

Route::prefix('v1')->group(function () {
    Route::middleware('auth:sanctum')->group(function () {
        Route::prefix('events')->group(function () {
            Route::get('upcoming', [EventController::class, 'index']);

            Route::middleware('role:organizer')->group(function () {
                Route::post('/store', [EventController::class, 'store']);
            });

            Route::get('/search', [EventController::class, 'search']);

        });

        Route::get('/user', function (Request $request) {
            return $request->user();
        })->middleware('auth:sanctum');
    });
});
