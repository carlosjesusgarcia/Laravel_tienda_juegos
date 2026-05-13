<x-principal-layout>
    <x-slot:title>Blog</x-slot:title>

    <h1 class="display-4 fw-bold text-danger text-center mb-5">
        ARCHIVO GENERAL
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

    <div class="row g-4">
        @forelse ($posts as $post)
            <div class="col-12">
                <x-post-card :post="$post" />
            </div>
        @empty
            <div class="col-12 text-center">
                <p class="text-secondary">
                    No hay entradas publicadas en el archivo.
                </p>
            </div>
        @endforelse
    </div>
</x-principal-layout>
