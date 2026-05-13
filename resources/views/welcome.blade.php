<x-principal-layout>
    <x-slot:title>Inicio</x-slot:title>

    <div class="d-flex flex-column justify-content-center align-items-center text-center my-5">
        <h1 class="display-4 fw-bold text-info mb-4">
            ¡Benvenidos a Retro Games!
        </h1>

        <p class="lead mb-5">
            Acá vas a encontrar la mejor selección de videojuegos retro y consolas clásicas.
        </p>

        <a href="/juegos" class="btn btn-outline-warning btn-lg">
            Explorar Catálogo
        </a>
    </div>

    <hr class="border-secondary my-5">

    <div class="container mb-5">
        <h2 class="text-warning mb-4 fw-bold">Últimas Novedades del Archivo</h2>

        <div class="row">
            @foreach($posts as $post)
                <div class="col-12">
                    <x-post-card :post="$post" />
                </div>
            @endforeach
        </div>
    </div>
</x-principal-layout>
