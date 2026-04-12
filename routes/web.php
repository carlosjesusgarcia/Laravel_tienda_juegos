<?php

use Illuminate\Support\Facades\Route;

Route::get('/', [App\Http\Controllers\HomeController::class, 'home']);

Route::get('/nosotros', [App\Http\Controllers\HomeController::class, 'about']);

Route::get('/login', [App\Http\Controllers\HomeController::class, 'login']);

Route::get('/juegos/listado', [App\Http\Controllers\MoviesController::class, 'index']);

/* Route::get('/', function () {
    return view('welcome');
}); */

/* Route::get('/nosotros', function () {
    return view('about');
});

Route::get('/charlie', function () {
    return view('charlie');
});
 */
