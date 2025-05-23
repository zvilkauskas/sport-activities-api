<?php

use App\Http\Controllers\Api\Activities\ActivityController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix('activities')->group(function () {
    Route::get('/', [ActivityController::class, 'index'])->name('activities.index');
    Route::get('/{activity}', [ActivityController::class, 'show'])->name('activities.show');
});
