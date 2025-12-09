<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HolaController;
use App\Http\Controllers\ArticlesController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\ProfileController;

/*

Rutas públicas

*/

// Ruta principal
Route::get('/', function () {
    return redirect()->route('articles.index');
});

// Rutas de Hola
Route::get('/hola/{nombre}', [HolaController::class, 'show']);
Route::get('/hola', [HolaController::class, 'index']);

// Ruta de pruebas Eloquent
Route::get('/eloquent-test', [ArticlesController::class, 'testQueries'])
    ->middleware('auth')
    ->name('eloquent.test');

/*

Rutas de Artículos

IMPORTANTE: Primero las rutas específicas (create, store),
después la ruta dinámica {id} para evitar conflictos.
*/

// Listado de artículos
Route::get('/articles', [ArticleController::class, 'index'])->name('articles.index');

// Formulario de creación
Route::get('/articles/create', [ArticleController::class, 'create'])
    ->middleware('auth')
    ->name('articles.create');

// Guardar artículo
Route::post('/articles', [ArticleController::class, 'store'])
    ->middleware('auth')
    ->name('articles.store');

// Borrar artículo
Route::delete('/articles/{id}', [ArticleController::class, 'destroy'])
    ->middleware('auth')
    ->whereNumber('id')
    ->name('articles.destroy');

// Mostrar artículo (detalle)
Route::get('/articles/{id}', [ArticleController::class, 'show'])
    ->whereNumber('id')
    ->name('articles.show');

    // Formulario de edición
Route::get('/articles/{id}/edit', [ArticleController::class, 'edit'])
    ->middleware('auth')
    ->whereNumber('id')
    ->name('articles.edit');

// Actualizar artículo
Route::put('/articles/{id}', [ArticleController::class, 'update'])
    ->middleware('auth')
    ->whereNumber('id')
    ->name('articles.update');

/*

Rutas de Dashboard y Perfil (Breeze)

*/

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Rutas de autenticación Breeze
require __DIR__.'/auth.php';
