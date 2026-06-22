<x-principal-layout>
    <x-slot:title>Blog</x-slot:title>

    <h1 class="display-4 fw-bold text-danger text-center mb-5">
        NOTICIAS
    </h1>

    <p class="text-center text-secondary mb-5">
        Explora nuestros artículos, análisis y novedades del mundo retro.
    </p>

    @auth
        <div class="text-center mb-5">
            <a href="{{ route('posts.crear') }}" class="btn btn-vhs-cyan fw-bold px-4">
                [ PUBLICAR NUEVA ENTRADA ]
            </a>
        </div>
    @endauth

    <x-buscador
        action="{{ route('posts.listado') }}"
        titulo="Buscar noticias"
        label="Título"
        name="s-title"
        id="s-title"
        value="{{ $parametrosBusqueda['s-title'] ?? '' }}"
        button="Buscar"
    />

    @if($parametrosBusqueda['s-title'] !== null)
        @if($posts->isNotEmpty())
            <p class="text-secondary mb-4">
                <i>Se muestran los resultados para "<b>{{ $parametrosBusqueda['s-title'] }}</b>".</i>
            </p>
        @else
            <p class="text-secondary mb-4">
                No se encontraron resultados para la búsqueda "<b>{{ $parametrosBusqueda['s-title'] }}</b>".
            </p>
        @endif
    @endif

    <div class="row g-4">
        @forelse ($posts as $post)
            <div class="col-12">
                <x-post-card :post="$post" />
            </div>
        @empty
            @if($parametrosBusqueda['s-title'] === null)
                <div class="col-12 text-center">
                    <p class="text-secondary">
                        No hay entradas publicadas en el archivo.
                    </p>
                </div>
            @endif
        @endforelse
    </div>

    <div class="mt-5 d-flex justify-content-center">
        {{ $posts->appends($parametrosBusqueda)->links() }}
    </div>
</x-principal-layout>
