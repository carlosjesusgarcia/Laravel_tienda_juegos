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
 * | Rutas del Perfil
 * |--------------------------------------------------------------------------
 * | Permiten que el usuario autenticado consulte y actualice sus datos
 * | personales y visualice su historial de compras.
 */

Route::get('/perfil', [\App\Http\Controllers\PerfilController::class, 'index'])
    ->name('perfil.index')
    ->middleware('auth');

Route::get('/perfil/editar', [\App\Http\Controllers\PerfilController::class, 'editar'])
    ->name('perfil.editar')
    ->middleware('auth');

Route::put('/perfil/editar', [\App\Http\Controllers\PerfilController::class, 'actualizar'])
    ->name('perfil.actualizar')
    ->middleware('auth');

/**
 * |--------------------------------------------------------------------------
 * | Rutas del Carrito de Compras
 * |--------------------------------------------------------------------------
 * | Administran los juegos almacenados temporalmente en la sesión
 * | del usuario autenticado.
 */

Route::get('/carrito', [\App\Http\Controllers\CarritoController::class, 'index'])
    ->name('carrito.index')
    ->middleware('auth');

Route::post('/carrito/{id}', [\App\Http\Controllers\CarritoController::class, 'agregar'])
    ->name('carrito.agregar')
    ->middleware('auth');

Route::put('/carrito/{id}', [\App\Http\Controllers\CarritoController::class, 'actualizar'])
    ->name('carrito.actualizar')
    ->middleware('auth');

Route::delete('/carrito/{id}', [\App\Http\Controllers\CarritoController::class, 'eliminar'])
    ->name('carrito.eliminar')
    ->middleware('auth');

Route::delete('/carrito', [\App\Http\Controllers\CarritoController::class, 'vaciar'])
    ->name('carrito.vaciar')
    ->middleware('auth');

/**
 * |--------------------------------------------------------------------------
 * | Rutas de Compras
 * |--------------------------------------------------------------------------
 * | Permiten confirmar y registrar una compra, consultar el historial
 * | y visualizar el detalle de cada pedido.
 */

Route::get('/compras', [\App\Http\Controllers\CompraController::class, 'index'])
    ->name('compras.index')
    ->middleware('auth');

Route::get('/compras/confirmar', [\App\Http\Controllers\CompraController::class, 'confirmar'])
    ->name('compras.confirmar')
    ->middleware('auth');

Route::post('/compras/guardar', [\App\Http\Controllers\CompraController::class, 'guardar'])
    ->name('compras.guardar')
    ->middleware('auth');

Route::get('/compras/{id}', [\App\Http\Controllers\CompraController::class, 'detalles'])
    ->name('compras.detalles')
    ->middleware('auth');

/**
 * |--------------------------------------------------------------------------
 * | Rutas del Panel de Administración
 * |--------------------------------------------------------------------------
 * | Rutas restringidas para usuarios autenticados con rol administrador.
 */

Route::get('/admin', [\App\Http\Controllers\AdminController::class, 'index'])
    ->name('admin.index')
    ->middleware('auth')
    ->middleware('admin');

Route::get('/admin/usuarios', [\App\Http\Controllers\AdminUsuariosController::class, 'index'])
    ->name('admin.usuarios.index')
    ->middleware('auth')
    ->middleware('admin');

Route::get('/admin/usuarios/{id}', [\App\Http\Controllers\AdminUsuariosController::class, 'detalles'])
    ->name('admin.usuarios.detalles')
    ->middleware('auth')
    ->middleware('admin');

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