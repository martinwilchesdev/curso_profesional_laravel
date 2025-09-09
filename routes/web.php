<?php

use App\Http\Controllers\FriendController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {
    Route::get('/', [PageController::class, 'dashboard'])->name('dashboard');

    // crear una nueva publicacion
    Route::post('/', [PostController::class, 'store'])->name('posts.store');
    // mostrar el listado de publicaciones relacionadas a un usuario
    Route::get('/friend-profile/{user}', [PageController::class, 'friendProfile'])->name('friendProfile.show');
    // realizar una solicitud de amistad
    Route::post('/friends/{user}', [FriendController::class, 'store'])->name('friends.store');
    // listar el estado de las solicitudes de amistad realizadas
    Route::get('/status', [PageController::class, 'status'])->name('status');
});
