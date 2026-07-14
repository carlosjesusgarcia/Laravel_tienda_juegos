<x-principal-layout>

    <x-slot:title>Blog</x-slot:title>

    {{-- ENCABEZADO DEL BLOG --}}
    <section
        class="my-5 p-4 p-lg-5 border border-secondary rounded"
        aria-labelledby="titulo-blog"
    >
        <div class="row align-items-center g-4">

            <div class="col-lg-8">
                <p class="text-info fw-bold mb-2">
                    HISTORIA · ANÁLISIS · CULTURA GAMER
                </p>

                <h1
                    id="titulo-blog"
                    class="display-4 fw-bold mb-4"
                >
                    Archivo Retro
                </h1>

                <p class="lead text-light mb-3">
                    Noticias, artículos y curiosidades sobre videojuegos clásicos.
                </p>

                <p class="text-secondary mb-0">
                    Explorá publicaciones dedicadas a la historia del videojuego,
                    las consolas, los salones arcade y la cultura retro.
                </p>
            </div>

            <div class="col-lg-4">
                <div class="p-4 border border-info rounded text-center">
                    <p class="display-5 fw-bold text-light mb-2">
                        PRESS START
                    </p>

                    <p class="text-warning fw-bold mb-0">
                        LEÉ · DESCUBRÍ · RECORDÁ
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
                aria-labelledby="titulo-administracion-blog"
            >
                <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">

                    <div>
                        <p class="text-info fw-bold mb-2">
                            PANEL DE ADMINISTRACIÓN
                        </p>

                        <h2
                            id="titulo-administracion-blog"
                            class="h3 text-light fw-bold mb-0"
                        >
                            Gestión de publicaciones
                        </h2>
                    </div>

                    <a
                        href="{{ route('posts.crear') }}"
                        class="btn btn-vhs-cyan fw-bold px-4"
                    >
                        Publicar nueva entrada
                    </a>

                </div>
            </section>
        @endif
    @endauth

    {{-- BUSCADOR --}}
    <x-buscador
        action="{{ route('posts.listado') }}"
        titulo="Buscar en el archivo"
        label="Título de la publicación"
        name="s-title"
        id="s-title"
        value="{{ $parametrosBusqueda['s-title'] ?? '' }}"
        button="Buscar"
    />

    @if($parametrosBusqueda['s-title'] !== null)
        @if($posts->isNotEmpty())
            <p class="text-secondary mb-4">
                Se muestran los resultados para
                <strong class="text-light">
                    “{{ $parametrosBusqueda['s-title'] }}”
                </strong>.
            </p>
        @else
            <div
                class="alert alert-info mb-5"
                role="status"
            >
                No se encontraron resultados para
                <strong>
                    “{{ $parametrosBusqueda['s-title'] }}”
                </strong>.
            </div>
        @endif
    @endif

    {{-- LISTADO DE PUBLICACIONES --}}
    <section
        class="mb-5"
        aria-labelledby="titulo-publicaciones"
    >
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-end gap-3 mb-4">

            <div>
                <p class="text-info fw-bold mb-2">
                    ÚLTIMAS PUBLICACIONES
                </p>

                <h2
                    id="titulo-publicaciones"
                    class="text-warning fw-bold mb-0"
                >
                    Entradas del archivo retro
                </h2>
            </div>

        </div>

        <div class="row g-4">
            @forelse($posts as $post)
                <div class="col-12 col-lg-6">
                    <x-post-card :post="$post" />
                </div>
            @empty
                @if($parametrosBusqueda['s-title'] === null)
                    <div class="col-12">
                        <div
                            class="alert alert-info text-center"
                            role="status"
                        >
                            No hay entradas publicadas en el archivo.
                        </div>
                    </div>
                @endif
            @endforelse
        </div>

        @if($posts->hasPages())
            <div class="mt-5 d-flex justify-content-center">
                {{ $posts->appends($parametrosBusqueda)->links() }}
            </div>
        @endif
    </section>

</x-principal-layout>