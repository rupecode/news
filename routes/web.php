<?php

use App\Http\Controllers\Api\NewsController;
use App\Http\Controllers\LandingController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', [LandingController::class, 'blog'])->name('/');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');

    Route::get('news', [NewsController::class, 'index'])->name('news.index');
    Route::get('news/{id}', [NewsController::class, 'show'])
        ->name('news.show')
        ->middleware(['permission:view']);
});
