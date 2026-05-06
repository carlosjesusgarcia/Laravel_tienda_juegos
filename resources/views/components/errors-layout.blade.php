@props(['title', 'code', 'message'])

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>
<body class="body-404">
    <div class="error-container">
        <h1 class="glitch">{{ $code }}</h1>
        <p class="msg-sub">> {{ $message }}</p>

        <div class="text-light mb-4">
            {{ $slot }}
        </div>

        <a href="{{ route('juegos.listado') }}" class="btn btn-vhs-yellow">
            [ VOLVER AL ARCHIVO ]
        </a>
    </div>
</body>
</html>
