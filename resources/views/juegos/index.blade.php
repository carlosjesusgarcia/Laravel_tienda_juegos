<x-principal-layout>

    <x-slot:title>Catálogo de juegos</x-slot:title>

    {{-- ENCABEZADO DEL CATÁLOGO --}}
    <section
        class="my-5 p-4 p-lg-5 border border-secondary rounded"
        aria-labelledby="titulo-catalogo"
    >

        <div class="row align-items-center g-4">

            <div class="col-lg-8">

                <p class="text-info fw-bold mb-2">
                    CARTUCHOS · CONSOLAS · ARCADE
                </p>

                <h1
                    id="titulo-catalogo"
                    class="display-4 fw-bold mb-4"
                >
                    Catálogo de Retro Games
                </h1>

                <p class="lead text-light mb-3">
                    Explorá nuestra colección de videojuegos clásicos.
                </p>

                <p class="text-secondary mb-0">
                    Consultá la portada, el precio, la clasificación y los géneros
                    de cada título antes de agregarlo a tu colección.
                </p>

            </div>

            <div class="col-lg-4">

                <div class="p-4 border border-info rounded text-center">

                    <p class="display-5 fw-bold text-light mb-2">
                        8-BIT
                    </p>

                    <p class="text-warning fw-bold mb-0">
                        ELEGÍ TU PRÓXIMO CLÁSICO
                    </p>

                </div>

            </div>

        </div>

    </section>

    {{-- ACCIONES DE ADMINISTRACIÓN --}}
    @auth

        @if(Auth::user()->rol_fk == 1)

            <section
                class="mb-5"
                aria-labelledby="titulo-administracion"
            >

                <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">

                    <div>

                        <p class="text-info fw-bold mb-2">
                            PANEL DE ADMINISTRACIÓN
                        </p>

                        <h2
                            id="titulo-administracion"
                            class="h3 text-light fw-bold mb-0"
                        >
                            Gestión del catálogo
                        </h2>

                    </div>

                    <a
                        href="{{ route('juegos.crear') }}"
                        class="btn btn-vhs-cyan fw-bold px-4"
                    >
                        Registrar nuevo juego
                    </a>

                </div>

            </section>

        @endif

    @endauth

    {{-- BUSCADOR POR TÍTULO --}}
    <x-buscador
        action="{{ route('juegos.listado') }}"
        titulo="Buscar en el catálogo"
        label="Título del juego"
        name="s-title"
        id="s-title"
        value="{{ $parametrosBusqueda['s-title'] ?? '' }}"
        button="Buscar"
    />

    {{-- FILTROS --}}
    <section
        class="mb-5 p-4 border border-secondary rounded"
        aria-labelledby="titulo-filtros"
    >

        <div class="mb-4">

            <p class="text-info fw-bold mb-2">
                REFINAR RESULTADOS
            </p>

            <h2
                id="titulo-filtros"
                class="h3 text-warning fw-bold mb-0"
            >
                Filtrar catálogo
            </h2>

        </div>

        <form
            action="{{ route('juegos.listado') }}"
            method="get"
        >

            <div class="row g-3 align-items-end">

                <div class="col-md-5">

                    <label
                        for="s-clasificacion"
                        class="form-label"
                    >
                        Clasificación por edad
                    </label>

                    <select
                        name="s-clasificacion"
                        id="s-clasificacion"
                        class="form-select"
                    >

                        <option value="">
                            Todas las clasificaciones
                        </option>

                        @foreach($clasificaciones as $clasificacion)

                            <option
                                value="{{ $clasificacion->rating_id }}"
                                @if($parametrosBusqueda['s-clasificacion'] == $clasificacion->rating_id)
                                    selected
                                @endif
                            >
                                {{ $clasificacion->nombre }}
                                ({{ $clasificacion->abreviatura }})
                            </option>

                        @endforeach

                    </select>

                </div>

                <div class="col-md-5">

                    <label
                        for="s-genero"
                        class="form-label"
                    >
                        Género
                    </label>

                    <select
                        name="s-genero"
                        id="s-genero"
                        class="form-select"
                    >

                        <option value="">
                            Todos los géneros
                        </option>

                        @foreach($generos as $genero)

                            <option
                                value="{{ $genero->genero_id }}"
                                @if($parametrosBusqueda['s-genero'] == $genero->genero_id)
                                    selected
                                @endif
                            >
                                {{ $genero->nombre }}
                            </option>

                        @endforeach

                    </select>

                </div>

                <div class="col-md-2">

                    <button
                        type="submit"
                        class="btn btn-vhs-cyan w-100 fw-bold"
                    >
                        Filtrar
                    </button>

                </div>

            </div>

            <div class="mt-3">

                <a
                    href="{{ route('juegos.listado') }}"
                    class="text-info"
                >
                    Limpiar búsqueda y filtros
                </a>

            </div>

        </form>

    </section>

    {{-- RESULTADOS --}}
    <section
        class="mb-5"
        aria-labelledby="titulo-resultados"
    >

        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-end gap-3 mb-4">

            <div>

                <p class="text-info fw-bold mb-2">
                    COLECCIÓN DISPONIBLE
                </p>

                <h2
                    id="titulo-resultados"
                    class="text-warning fw-bold mb-0"
                >
                    Juegos del catálogo
                </h2>

            </div>

            @if($parametrosBusqueda['s-title'] !== null)

                @if($juegos->isNotEmpty())

                    <p class="text-secondary mb-0">
                        Resultados para
                        <strong class="text-light">
                            “{{ $parametrosBusqueda['s-title'] }}”
                        </strong>
                    </p>

                @endif

            @endif

        </div>

        @if($parametrosBusqueda['s-title'] !== null && $juegos->isEmpty())

            <div
                class="alert alert-info"
                role="status"
            >
                No se encontraron resultados para
                <strong>
                    “{{ $parametrosBusqueda['s-title'] }}”
                </strong>.
            </div>

        @endif

        <div class="row g-4">

            @forelse($juegos as $juego)

                <x-game-card :juego="$juego" />

            @empty

                @if($parametrosBusqueda['s-title'] === null)

                    <div class="col-12">

                        <div
                            class="alert alert-info text-center"
                            role="status"
                        >
                            No hay juegos disponibles para los filtros seleccionados.
                        </div>

                    </div>

                @endif

            @endforelse

        </div>

        @if($juegos->hasPages())

            <nav
                class="mt-5 d-flex justify-content-center"
                aria-label="Paginación del catálogo de juegos"
            >
                {{ $juegos->appends($parametrosBusqueda)->links() }}
            </nav>

        @endif

    </section>

</x-principal-layout>