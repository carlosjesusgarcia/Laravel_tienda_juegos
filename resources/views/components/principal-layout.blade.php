<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title ?? '' }} :: Retro Games</title>

    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
</head>
<body class="bg-dark text-light d-flex flex-column min-vh-100">

    <div id="app" class="d-flex flex-column min-vh-100">
        <x-navbar />

        <main class="container flex-grow-1 py-5">
            {{--
             |--------------------------------------------------------------------------
             | Sistema de Notificaciones (Flash Messages)
             |--------------------------------------------------------------------------
             | Verifica si el controlador ha "flasheado" un mensaje de feedback en la sesión.
             | Si existe, renderiza una alerta de Bootstrap.
             | Nota: Se utilizan llaves con signos de exclamación {!! !!} para evitar
             | que Blade escape las etiquetas HTML generadas desde el controlador (ej: <b>).
             --}}
            @if(session()->has('feedback.message'))
                <div class="alert alert-success fw-bold text-center mb-4 border-success shadow-sm" role="alert">
                    {!! session()->get('feedback.message') !!}
                </div>
            @endif

            {{-- Contenido dinámico inyectado por las vistas hijas --}}
            {{ $slot }}
        </main>

        <x-footer />
    </div>

    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>
