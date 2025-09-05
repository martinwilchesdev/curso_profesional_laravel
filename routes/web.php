<?php

use App\Http\Controllers\PageController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {
    Route::get('/', [PageController::class, 'dashboard'])->name('dashboard');

    Route::post('/', [PostController::class, 'store'])->name('posts.store'); // posts.store -> ruta // store -> metodo del controlador
});
