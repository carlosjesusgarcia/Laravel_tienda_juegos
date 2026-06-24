<x-principal-layout>
    <x-slot:title>Inicio</x-slot:title>

    <section class="text-center my-5 py-5 border border-secondary rounded">
        <p class="text-warning fw-bold mb-3">
            TIENDA DE VIDEOJUEGOS CLÁSICOS
        </p>

        <h1 class="display-3 fw-bold text-danger mb-4">
            RETRO GAMES
        </h1>

        <p class="lead text-light mb-4">
            Videojuegos clásicos, cartuchos legendarios y cultura arcade en un solo catálogo.
        </p>

        <p class="text-secondary mb-5">
            Explorá una selección de juegos retro pensada para coleccionistas,
            jugadores nostálgicos y amantes de las consolas clásicas.
        </p>

        <div class="d-flex flex-column flex-md-row justify-content-center gap-3">
            <a href="{{ route('juegos.listado') }}" class="btn btn-vhs-yellow btn-lg fw-bold">
                [ EXPLORAR CATÁLOGO ]
            </a>

            <a href="{{ route('posts.listado') }}" class="btn btn-vhs-cyan btn-lg fw-bold">
                [ LEER BLOG RETRO ]
            </a>
        </div>
    </section>

    <section class="mb-5">
        <h2 class="h2 text-warning fw-bold text-center mb-4">
            ¿QUÉ OFRECE RETRO GAMES?
        </h2>

        <div class="row g-4">
            <div class="col-md-4">
                <article class="h-100 p-4 border border-secondary rounded">
                    <h3 class="h4 text-info fw-bold mb-3">
                        Catálogo retro
                    </h3>

                    <p class="text-secondary mb-0">
                        Juegos clásicos seleccionados con título, precio,
                        clasificación, géneros, portada y sinopsis.
                    </p>
                </article>
            </div>

            <div class="col-md-4">
                <article class="h-100 p-4 border border-secondary rounded">
                    <h3 class="h4 text-info fw-bold mb-3">
                        Archivo de cartuchos
                    </h3>

                    <p class="text-secondary mb-0">
                        Cada juego funciona como una ficha de colección,
                        con información clara para consultar antes de comprar.
                    </p>
                </article>
            </div>

            <div class="col-md-4">
                <article class="h-100 p-4 border border-secondary rounded">
                    <h3 class="h4 text-info fw-bold mb-3">
                        Cultura gamer
                    </h3>

                    <p class="text-secondary mb-0">
                        Un blog con noticias, historia, curiosidades y contenido
                        sobre videojuegos retro y cultura arcade.
                    </p>
                </article>
            </div>
        </div>
    </section>

    <section class="mb-5 p-4 border border-secondary rounded">
        <div class="row align-items-center g-4">
            <div class="col-md-7">
                <h2 class="h2 text-warning fw-bold mb-4">
                    CATÁLOGO DE VIDEOJUEGOS CLÁSICOS
                </h2>

                <p class="text-light">
                    Nuestro catálogo reúne videojuegos icónicos de distintas épocas:
                    arcade, acción, aventura, plataformas, lucha y clásicos familiares.
                </p>

                <p class="text-secondary mb-0">
                    Cada ficha permite consultar la portada, descripción, precio,
                    clasificación y géneros asociados.
                </p>
            </div>

            <div class="col-md-5 text-center">
                <div class="p-4 border border-danger rounded">
                    <p class="display-6 text-danger fw-bold mb-3">
                        8-BIT
                    </p>

                    <p class="text-warning fw-bold mb-3">
                        CARTUCHOS · CONSOLAS · ARCADE
                    </p>

                    <a href="{{ route('juegos.listado') }}" class="btn btn-vhs-yellow fw-bold">
                        [ VER JUEGOS DISPONIBLES ]
                    </a>
                </div>
            </div>
        </div>
    </section>

    <section class="mb-5">
        <h2 class="h2 text-warning fw-bold text-center mb-4">
            ¿POR QUÉ ELEGIR RETRO GAMES?
        </h2>

        <div class="row g-4">
            <div class="col-md-4">
                <div class="h-100 p-4 border border-secondary rounded text-center">
                    <p class="text-danger fw-bold fs-4 mb-2">
                        01
                    </p>

                    <p class="text-light mb-0">
                        Selección curada de juegos clásicos.
                    </p>
                </div>
            </div>

            <div class="col-md-4">
                <div class="h-100 p-4 border border-secondary rounded text-center">
                    <p class="text-danger fw-bold fs-4 mb-2">
                        02
                    </p>

                    <p class="text-light mb-0">
                        Diseño visual inspirado en estética VHS, arcade y cultura ochentosa.
                    </p>
                </div>
            </div>

            <div class="col-md-4">
                <div class="h-100 p-4 border border-secondary rounded text-center">
                    <p class="text-danger fw-bold fs-4 mb-2">
                        03
                    </p>

                    <p class="text-light mb-0">
                        Sistema con usuarios registrados, catálogo administrable y compras asociadas.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <hr class="border-secondary my-5">

    <section class="container mb-5">
        <h2 class="text-warning mb-4 fw-bold">
            ÚLTIMAS ENTRADAS DEL ARCHIVO RETRO
        </h2>

        <div class="row">
            @foreach($posts as $post)
                <div class="col-12">
                    <x-post-card :post="$post" />
                </div>
            @endforeach
        </div>
    </section>
</x-principal-layout>
