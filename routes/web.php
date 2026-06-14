<?php

use Illuminate\Support\Facades\Route;

/**
 * |--------------------------------------------------------------------------
 * | Rutas Principales (Páginas Estáticas)
 * |--------------------------------------------------------------------------
 * | Rutas encargadas de renderizar las vistas informativas y de
 * | autenticación base de la aplicación.
 */

Route::get('/', [\App\Http\Controllers\HomeController::class, 'home'])
    ->name('home');

Route::get('/nosotros', [\App\Http\Controllers\HomeController::class, 'about'])
    ->name('nosotros');

// Rutas de Autenticación
Route::get('/login', [\App\Http\Controllers\AuthController::class, 'login'])
    ->name('login');

Route::post('/login', [\App\Http\Controllers\AuthController::class, 'process'])
    ->name('login.process');

Route::get('/registro', [\App\Http\Controllers\AuthController::class, 'registro'])
    ->name('registro');

Route::post('/registro', [\App\Http\Controllers\AuthController::class, 'guardarRegistro'])
    ->name('registro.guardar');

// Cerrar sesión requiere que el usuario esté logueado previamente
Route::post('/cerrar-sesion', [\App\Http\Controllers\AuthController::class, 'logout'])
    ->name('logout')
    ->middleware('auth');

/**
 * |--------------------------------------------------------------------------
 * | Rutas del Archivo de Juegos (CRUD)
 * |--------------------------------------------------------------------------
 * | Gestionan el ciclo de vida de la entidad Juego.
 * | Las rutas de administración requieren autenticación y rol administrador.
 */

/**
 * 1. Listado general (Read All) - PÚBLICO
 */
Route::get('/juegos', [\App\Http\Controllers\JuegosController::class, 'index'])
    ->name('juegos.listado');

/**
 * 2. Formulario de creación (Create - Formulario) - SOLO ADMINISTRADOR
 */
Route::get('/juegos/nuevo', [\App\Http\Controllers\JuegosController::class, 'crear'])
    ->name('juegos.crear')
    ->middleware('auth')
    ->middleware('admin');

/**
 * 3. Persistencia de nuevo registro (Create - Lógica) - SOLO ADMINISTRADOR
 */
Route::post('/juegos/nuevo', [\App\Http\Controllers\JuegosController::class, 'guardar'])
    ->name('juegos.guardar')
    ->middleware('auth')
    ->middleware('admin');

/**
 * 4. Detalles de un juego específico (Read One) - PÚBLICO
 */
Route::get('/juegos/{juego}', [\App\Http\Controllers\JuegosController::class, 'detalles'])
    ->name('juegos.detalles');

/**
 * 5. Formulario de edición (Update - Formulario) - SOLO ADMINISTRADOR
 */
Route::get('/juegos/{juego}/editar', [\App\Http\Controllers\JuegosController::class, 'editar'])
    ->name('juegos.editar')
    ->middleware('auth')
    ->middleware('admin');

/**
 * 6. Actualización de registro (Update - Lógica) - SOLO ADMINISTRADOR
 */
Route::put('/juegos/{juego}/editar', [\App\Http\Controllers\JuegosController::class, 'actualizar'])
    ->name('juegos.actualizar')
    ->middleware('auth')
    ->middleware('admin');

/**
 * 7. Formulario de confirmación de eliminación (Delete - Vista previa) - SOLO ADMINISTRADOR
 */
Route::get('/juegos/{juego}/eliminar', [\App\Http\Controllers\JuegosController::class, 'confirmarEliminacion'])
    ->name('juegos.confirmar_eliminar')
    ->middleware('auth')
    ->middleware('admin');

/**
 * 8. Eliminación de un juego (Delete - Lógica) - SOLO ADMINISTRADOR
 */
Route::post('/juegos/{juego}/eliminar', [\App\Http\Controllers\JuegosController::class, 'eliminar'])
    ->name('juegos.eliminar')
    ->middleware('auth')
    ->middleware('admin');

/**
 * |--------------------------------------------------------------------------
 * | Rutas del Blog / Noticias (CRUD)
 * |--------------------------------------------------------------------------
 * | Gestionan el ciclo de vida de las entradas del blog.
 * | Las rutas de administración requieren autenticación y rol administrador.
 */

/**
 * 1. Listado general del blog - PÚBLICO
 */
Route::get('/blog', [\App\Http\Controllers\PostController::class, 'index'])
    ->name('posts.listado');

/**
 * 2. Formulario de creación de entrada - SOLO ADMINISTRADOR
 */
Route::get('/blog/nuevo', [\App\Http\Controllers\PostController::class, 'crear'])
    ->name('posts.crear')
    ->middleware('auth')
    ->middleware('admin');

/**
 * 3. Persistencia de nueva entrada - SOLO ADMINISTRADOR
 */
Route::post('/blog/nuevo', [\App\Http\Controllers\PostController::class, 'guardar'])
    ->name('posts.guardar')
    ->middleware('auth')
    ->middleware('admin');

/**
 * 4. Lectura de una entrada específica - PÚBLICO
 */
Route::get('/blog/{post}', [\App\Http\Controllers\PostController::class, 'leer'])
    ->name('posts.leer');

/**
 * 5. Formulario de edición - SOLO ADMINISTRADOR
 */
Route::get('/blog/{post}/editar', [\App\Http\Controllers\PostController::class, 'editar'])
    ->name('posts.editar')
    ->middleware('auth')
    ->middleware('admin');

/**
 * 6. Actualización de entrada - SOLO ADMINISTRADOR
 */
Route::put('/blog/{post}/editar', [\App\Http\Controllers\PostController::class, 'actualizar'])
    ->name('posts.actualizar')
    ->middleware('auth')
    ->middleware('admin');

/**
 * 7. Formulario de confirmación de eliminación - SOLO ADMINISTRADOR
 */
Route::get('/blog/{post}/eliminar', [\App\Http\Controllers\PostController::class, 'confirmarEliminacion'])
    ->name('posts.confirmar_eliminar')
    ->middleware('auth')
    ->middleware('admin');

/**
 * 8. Eliminación de una entrada - SOLO ADMINISTRADOR
 */
Route::post('/blog/{post}/eliminar', [\App\Http\Controllers\PostController::class, 'eliminar'])
    ->name('posts.eliminar')
    ->middleware('auth')
    ->middleware('admin');
