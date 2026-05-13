<?php
/**
 * Archivo: app.php
 * Función: Construye y configura la instancia principal de la aplicación, orquestando el enrutamiento, la pila de middleware y el manejo de excepciones.
 */

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

        /**
         * Define la directiva de redirección para accesos no autorizados.
         *
         * Intercepta las solicitudes de clientes no autenticados hacia endpoints
         * protegidos y ejecuta una redirección al controlador de acceso. Alimenta
         * la sesión con variables transaccionales ('flash') para proveer
         * retroalimentación visual al usuario.
         *
         * @return string URL correspondiente a la ruta de inicio de sesión.
         */
        $middleware->redirectGuestsTo(function() {
            Session::flash('feedback.message', 'Para acceder a esta sección es necesario iniciar sesión.');
            Session::flash('feedback.type', 'danger');
            return route('login');
        });

    })
    ->withExceptions(function (Exceptions $exceptions): void {

    })->create();
