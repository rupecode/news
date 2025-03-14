<?php

use App\Http\Controllers\Api\NewsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::middleware([
    'auth:sanctum',
])->group(function () {
    Route::post('news', [NewsController::class, 'store'])
        ->name('news.store')
        ->middleware(['role:admin|user', 'permission:manage']);

    Route::delete('news/{id}', [NewsController::class, 'destroy'])
        ->name('news.delete')
        ->middleware(['role:admin|user', 'permission:manage']);

    Route::put('news/{id}', [NewsController::class, 'update'])
        ->name('news.update')
        ->middleware(['role:admin|user', 'permission:manage']);
});


