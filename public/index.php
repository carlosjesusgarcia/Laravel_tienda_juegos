<?php

use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

// Determine if the application is in maintenance mode...
//Busca el archivo de mantenimiento, si existe, lo incluye y detiene la ejecución del script.
//Si no existe, continúa con la carga normal de la aplicación.
if (file_exists($maintenance = __DIR__.'/../storage/framework/maintenance.php')) {
    require $maintenance;
}

// Register the Composer autoloader...
require __DIR__.'/../vendor/autoload.php';

// Bootstrap Laravel and handle the request...
// Boostrap quiere decir que se prepara la aplicación para ser ejecutada, cargando todas las dependencias, configuraciones y servicios necesarios.
/** @var Application $app */
$app = require_once __DIR__.'/../bootstrap/app.php';

$app->handleRequest(Request::capture());
