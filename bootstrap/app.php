<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Support\Facades\Session;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
  ->withMiddleware(function (Middleware $middleware) {

        // Configuramos a dónde queremos redireccionar al usuario si no está autenticado
        // y trata de ingresar a una ruta que requiera estarlo.
        $middleware->redirectGuestsTo(function() {
            Session::flash('feedback.message', 'Para acceder a esta sección es necesario iniciar sesión.');
            Session::flash('feedback.type', 'danger'); // <--- AGREGAMOS EL TIPO DE ALERTA (Rojo)
            return route('login');
        });

    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
