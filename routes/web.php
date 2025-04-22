<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Ruta al dashboard (requiere autenticación y verificación)
Route::get('/dashboard', [PostController::class, 'dashboard'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');
// Grupo de rutas que requieren estar autenticado
Route::middleware('auth')->group(function () {
    // Rutas para editar el perfil
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // ✅ Rutas para CRUD de publicaciones
    Route::resource('posts', PostController::class);
});

require __DIR__.'/auth.php';
