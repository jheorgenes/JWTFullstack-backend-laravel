<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/users', [ HomeController::class, 'index' ]);
Route::post('/auth', [ AuthController::class, 'auth' ]);
Route::get('/auth/verify', [ AuthController::class, 'verify' ]);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
