<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>{{ $title ?? '' }} :: Retro Games</title>

    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css"
    >
</head>
<body class="bg-dark text-light d-flex flex-column min-vh-100">
    <div id="app" class="d-flex flex-column min-vh-100">
        <x-navbar />

        <main class="container flex-grow-1 py-5">
            @if(session()->has('feedback.message'))
                {{--
                    Usamos session()->get('feedback.type', 'success') para imprimir
                    'danger' o 'success'.

                    El valor 'success' funciona como valor por defecto si no se
                    proporciona ningún tipo.
                --}}
                <div
                    class="alert alert-{{ session()->get('feedback.type', 'success') }}"
                    role="alert"
                >
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