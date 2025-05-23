<?php

use App\Http\Controllers\Api\ActivityController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('activities', [ActivityController::class, 'index']);
Route::get('activities/{activity}', [ActivityController::class, 'show']);
