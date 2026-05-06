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

// Cerrar sesión requiere que el usuario esté logueado previamente
Route::post('/cerrar-sesion', [\App\Http\Controllers\AuthController::class, 'logout'])
    ->name('logout')
    ->middleware('auth');

/**
 * |--------------------------------------------------------------------------
 * | Rutas del Archivo de Juegos (CRUD)
 * |--------------------------------------------------------------------------
 * | Gestionan el ciclo de vida de la entidad Juego (Listar, Crear, Leer, Actualizar, Eliminar).
 * | Nota: El orden de declaración prioriza las rutas estáticas sobre las dinámicas
 * | para evitar falsas coincidencias en la resolución de URLs.
 */

/**
 * 1. Listado general (Read All) - PÚBLICO
 */
Route::get('/juegos', [\App\Http\Controllers\JuegosController::class, 'index'])
    ->name('juegos.listado');

/*
 * # Protegiendo el acceso a las rutas que requieran de autenticación
 * Para asegurarnos de que solo un usuario autenticado pueda acceder a una determinada ruta,
 * agregamos el middleware "auth".
 */

/**
 * 2. Formulario de creación (Create - Formulario) - PROTEGIDO
 */
Route::get('/juegos/nuevo', [\App\Http\Controllers\JuegosController::class, 'crear'])
    ->name('juegos.crear')
    ->middleware('auth');

/**
 * 3. Persistencia de nuevo registro (Create - Lógica) - PROTEGIDO
 */
Route::post('/juegos/nuevo', [\App\Http\Controllers\JuegosController::class, 'guardar'])
    ->name('juegos.guardar')
    ->middleware('auth');

/**
 * 4. Detalles de un juego específico (Read One) - PÚBLICO
 */
Route::get('/juegos/{juego}', [\App\Http\Controllers\JuegosController::class, 'detalles'])
    ->name('juegos.detalles');

/**
 * 5. Formulario de edición (Update - Formulario) - PROTEGIDO
 */
Route::get('/juegos/{juego}/editar', [\App\Http\Controllers\JuegosController::class, 'editar'])
    ->name('juegos.editar')
    ->middleware('auth');

/**
 * 6. Actualización de registro (Update - Lógica) - PROTEGIDO
 */
Route::put('/juegos/{juego}/editar', [\App\Http\Controllers\JuegosController::class, 'actualizar'])
    ->name('juegos.actualizar')
    ->middleware('auth');

/**
 * 7. Formulario de confirmación de eliminación (Delete - Vista previa) - PROTEGIDO
 */
Route::get('/juegos/{juego}/eliminar', [\App\Http\Controllers\JuegosController::class, 'confirmarEliminacion'])
    ->name('juegos.confirmar_eliminar')
    ->middleware('auth');

/**
 * 8. Eliminación de un juego (Delete - Lógica) - PROTEGIDO
 */
Route::post('/juegos/{juego}/eliminar', [\App\Http\Controllers\JuegosController::class, 'eliminar'])
    ->name('juegos.eliminar')
    ->middleware('auth');
