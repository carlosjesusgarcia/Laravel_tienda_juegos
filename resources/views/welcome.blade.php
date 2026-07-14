<x-principal-layout>

    <x-slot:title>Inicio</x-slot:title>


   {{-- HERO PRINCIPAL --}}
<section
    class="my-5 border border-secondary rounded overflow-hidden"
    aria-labelledby="titulo-principal"
>
    <div class="row align-items-stretch g-0">

        <div class="col-lg-7 d-flex align-items-center">

            <div class="p-4 p-lg-5">

                <p class="text-warning fw-bold mb-3">
                    TIENDA DE VIDEOJUEGOS CLÁSICOS
                </p>

                <h1
                    id="titulo-principal"
                    class="display-3 fw-bold mb-4"
                >
                    RETRO GAMES
                </h1>

                <p class="lead text-light mb-3">
                    Videojuegos clásicos, cartuchos legendarios y cultura arcade
                    en un solo catálogo.
                </p>

                <p class="text-secondary mb-4">
                    Explorá una selección de títulos retro pensada para
                    coleccionistas, jugadores nostálgicos y amantes de las
                    consolas clásicas.
                </p>

                <div class="d-flex flex-column flex-sm-row gap-3">

                    <a
                        href="{{ route('juegos.listado') }}"
                        class="btn btn-vhs-yellow btn-lg fw-bold"
                    >
                        Explorar catálogo
                    </a>

                    <a
                        href="{{ route('posts.listado') }}"
                        class="btn btn-vhs-cyan btn-lg fw-bold"
                    >
                        Leer blog retro
                    </a>

                </div>

            </div>

        </div>

        <div class="col-lg-5">

            <img
                src="{{ asset('storage/home/hero.webp') }}"
                alt="Selección de videojuegos clásicos de Retro Games"
                class="w-100 h-100 object-fit-cover"
            >

        </div>

    </div>
</section>

    {{-- NAVEGACIÓN DESTACADA --}}
    <section
        class="mb-5"
        aria-labelledby="titulo-explorar"
    >

        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-end gap-3 mb-4">

            <div>

                <p class="text-info fw-bold mb-2">
                    EXPLORÁ RETRO GAMES
                </p>

                <h2
                    id="titulo-explorar"
                    class="text-warning fw-bold mb-0"
                >
                    Todo el universo retro en un solo lugar
                </h2>

            </div>

            <a
                href="{{ route('juegos.listado') }}"
                class="btn btn-vhs-cyan"
            >
                Ver catálogo completo
            </a>

        </div>

        <div class="row g-4">

            <div class="col-md-4">

                <article class="vhs-card h-100">

                    <div class="card-body">

                        <p class="text-info fw-bold mb-2">
                            CATÁLOGO
                        </p>

                        <h3 class="card-title">
                            Videojuegos clásicos
                        </h3>

                        <p class="card-text">
                            Descubrí títulos históricos con portada, precio,
                            clasificación, géneros y sinopsis.
                        </p>

                        <a
                            href="{{ route('juegos.listado') }}"
                            class="btn btn-vhs-yellow mt-auto"
                        >
                            Ver juegos
                        </a>

                    </div>

                </article>

            </div>

            <div class="col-md-4">

                <article class="vhs-card h-100">

                    <div class="card-body">

                        <p class="text-info fw-bold mb-2">
                            ARCHIVO
                        </p>

                        <h3 class="card-title">
                            Historia y cultura gamer
                        </h3>

                        <p class="card-text">
                            Leé noticias, análisis, curiosidades y publicaciones
                            sobre consolas, videojuegos y salones arcade.
                        </p>

                        <a
                            href="{{ route('posts.listado') }}"
                            class="btn btn-vhs-yellow mt-auto"
                        >
                            Leer publicaciones
                        </a>

                    </div>

                </article>

            </div>

            <div class="col-md-4">

                <article class="vhs-card h-100">

                    <div class="card-body">

                        <p class="text-info fw-bold mb-2">
                            COLECCIÓN
                        </p>

                        <h3 class="card-title">
                            Fichas detalladas
                        </h3>

                        <p class="card-text">
                            Consultá la información esencial de cada juego antes
                            de incorporarlo a tu colección.
                        </p>

                        <a
                            href="{{ route('juegos.listado') }}"
                            class="btn btn-vhs-yellow mt-auto"
                        >
                            Explorar fichas
                        </a>

                    </div>

                </article>

            </div>

        </div>

    </section>

    {{-- CÓMO FUNCIONA --}}
    <section
        class="mb-5 p-4 p-lg-5 border border-secondary rounded"
        aria-labelledby="titulo-como-funciona"
    >

        <div class="text-center mb-5">

            <p class="text-info fw-bold mb-2">
                UNA COMPRA SIMPLE
            </p>

            <h2
                id="titulo-como-funciona"
                class="text-warning fw-bold mb-3"
            >
                Encontrá tu próximo clásico
            </h2>

            <p class="text-secondary mb-0">
                Revisá el catálogo, conocé cada título y elegí los juegos que
                formarán parte de tu colección.
            </p>

        </div>

        <div class="row g-4">

            <div class="col-md-4">

                <article class="h-100 text-center">

                    <p
                        class="display-6 text-info fw-bold mb-3"
                        aria-hidden="true"
                    >
                        01
                    </p>

                    <h3 class="h4 text-light fw-bold mb-3">
                        Explorá
                    </h3>

                    <p class="text-secondary mb-0">
                        Navegá por el catálogo y filtrá los juegos por
                        clasificación y género.
                    </p>

                </article>

            </div>

            <div class="col-md-4">

                <article class="h-100 text-center">

                    <p
                        class="display-6 text-info fw-bold mb-3"
                        aria-hidden="true"
                    >
                        02
                    </p>

                    <h3 class="h4 text-light fw-bold mb-3">
                        Informate
                    </h3>

                    <p class="text-secondary mb-0">
                        Consultá la portada, la sinopsis, el precio y los datos
                        principales de cada videojuego.
                    </p>

                </article>

            </div>

            <div class="col-md-4">

                <article class="h-100 text-center">

                    <p
                        class="display-6 text-info fw-bold mb-3"
                        aria-hidden="true"
                    >
                        03
                    </p>

                    <h3 class="h4 text-light fw-bold mb-3">
                        Elegí
                    </h3>

                    <p class="text-secondary mb-0">
                        Seleccioná los clásicos que querés incorporar a tu
                        biblioteca personal.
                    </p>

                </article>

            </div>

        </div>

    </section>

    {{-- BLOQUE COMERCIAL --}}
    <section
        class="mb-5"
        aria-labelledby="titulo-coleccion"
    >

        <div class="row g-4 align-items-stretch">

            <div class="col-lg-8">

                <div class="h-100 p-4 p-lg-5 border border-secondary rounded">

                    <p class="text-info fw-bold mb-2">
                        CATÁLOGO DISPONIBLE
                    </p>

                    <h2
                        id="titulo-coleccion"
                        class="text-warning fw-bold mb-4"
                    >
                        Una colección para cada tipo de jugador
                    </h2>

                    <p class="text-light">
                        Retro Games reúne videojuegos de acción, aventura,
                        plataformas, lucha, arcade y clásicos familiares.
                    </p>

                    <p class="text-secondary mb-4">
                        Cada título cuenta con una ficha organizada para que
                        puedas identificar rápidamente sus características
                        principales.
                    </p>

                    <a
                        href="{{ route('juegos.listado') }}"
                        class="btn btn-vhs-yellow fw-bold"
                    >
                        Ver juegos disponibles
                    </a>

                </div>

            </div>

            <div class="col-lg-4">

                <aside
                    class="vhs-card h-100"
                    aria-labelledby="titulo-ventajas"
                >

                    <div class="card-body">

                        <p class="text-info fw-bold mb-2">
                            RETRO GAMES
                        </p>

                        <h2
                            id="titulo-ventajas"
                            class="card-title h3"
                        >
                            Una experiencia clara y organizada
                        </h2>

                        <ul class="text-secondary mb-0 ps-3">

                            <li class="mb-2">
                                Catálogo administrable.
                            </li>

                            <li class="mb-2">
                                Fichas detalladas.
                            </li>

                            <li class="mb-2">
                                Búsqueda y filtros.
                            </li>

                            <li>
                                Archivo de publicaciones.
                            </li>

                        </ul>

                    </div>

                </aside>

            </div>

        </div>

    </section>

    {{-- ÚLTIMAS PUBLICACIONES --}}
    <section
        class="mb-5"
        aria-labelledby="titulo-blog"
    >

        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-end gap-3 mb-4">

            <div>

                <p class="text-info fw-bold mb-2">
                    HISTORIA Y CULTURA GAMER
                </p>

                <h2
                    id="titulo-blog"
                    class="text-warning fw-bold mb-0"
                >
                    Últimas entradas del archivo retro
                </h2>

            </div>

            <a
                href="{{ route('posts.listado') }}"
                class="btn btn-vhs-cyan"
            >
                Ver todas las entradas
            </a>

        </div>

        @if($posts->isNotEmpty())

            <div class="row g-4">

                @foreach($posts as $post)

                    <div class="col-12 col-lg-6">

                        <x-post-card :post="$post" />

                    </div>

                @endforeach

            </div>

        @else

            <div
                class="alert alert-info text-center"
                role="status"
            >
                Todavía no hay publicaciones disponibles.
            </div>

        @endif

    </section>

    {{-- LLAMADA FINAL --}}
    <section
        class="mb-5 p-4 p-lg-5 border border-secondary rounded text-center"
        aria-labelledby="titulo-llamada-final"
    >

        <p class="text-info fw-bold mb-2">
            PREPARATE PARA JUGAR
        </p>

        <h2
            id="titulo-llamada-final"
            class="text-warning fw-bold mb-3"
        >
            Tu próxima aventura retro está en el catálogo
        </h2>

        <p class="text-secondary mb-4">
            Descubrí los videojuegos clásicos disponibles y elegí el próximo
            título para tu colección.
        </p>

        <a
            href="{{ route('juegos.listado') }}"
            class="btn btn-vhs-yellow btn-lg fw-bold"
        >
            Explorar Retro Games
        </a>

    </section>

</x-principal-layout>