<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title> {{ $title ?? '' }} :: Retro Games </title>

    <link rel="stylesheet" href="{{ url('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ url('css/styles.css') }}">
</head>
<body class="bg-dark text-light">

    <div id="app">
        <x-navbar />

        <main class="container flex-grow-1 py-5">
            {{ $slot }}
        </main>

        <x-footer />
    </div>

    <script src="{{ url('js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>
