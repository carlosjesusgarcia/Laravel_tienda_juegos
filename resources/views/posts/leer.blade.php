<x-principal-layout>
    <x-slot:title>Archivo: {{ $post->titulo }}</x-slot:title>

    <article class="container py-5">
        <div class="mb-4 d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">
            <a href="{{ route('posts.listado') }}" class="btn btn-vhs-yellow">
                <i class="bi bi-arrow-left"></i> [ VOLVER AL BLOG ]
            </a>

            @auth
                @if(Auth::user()->rol_fk == 1)
                    <div class="d-flex gap-2">
                        <a href="{{ route('posts.editar', $post) }}" class="btn btn-success fw-bold px-4">
                            EDITAR
                        </a>

                        <a href="{{ route('posts.confirmar_eliminar', $post) }}" class="btn btn-danger fw-bold px-4">
                            ELIMINAR
                        </a>
                    </div>
                @endif
            @endauth
        </div>

        <div class="row g-5">
            <section class="col-md-5">
                <div class="vhs-card p-3 shadow-lg">
                    @if($post->imagen !== null && \Storage::exists($post->imagen))
                        <img
                            src="{{ \Storage::url($post->imagen) }}"
                            class="img-fluid w-100"
                            alt="{{ $post->imagen_descripcion ?? 'Imagen de la entrada ' . $post->titulo }}"
                            style="filter: grayscale(0.2) contrast(1.2);"
                        >
                    @else
                        <img
                            src="{{ url('img/fallback-vhs.jpg') }}"
                            class="img-fluid w-100"
                            alt="Sin imagen disponible en el servidor"
                            style="filter: grayscale(0.2) contrast(1.2);"
                        >
                    @endif
                </div>
            </section>

            <section class="col-md-7">
                <h1 class="display-3 fw-bold text-uppercase mb-2" style="color: #ff3355; text-shadow: 0 0 10px rgba(255, 51, 85, 0.6);">
                    {{ $post->titulo }}
                </h1>

                @if($post->subtitulo)
                    <h2 class="h4 text-warning mb-3 fw-bold" style="letter-spacing: 1px;">
                        {{ $post->subtitulo }}
                    </h2>
                @endif

                <div class="d-flex align-items-center gap-3 mb-4">
                    <span class="text-secondary fw-bold">FECHA: {{ $post->created_at->format('d/m/Y') }}</span>
                    <span class="text-info fw-bold">ID: #{{ str_pad($post->post_id, 4, '0', STR_PAD_LEFT) }}</span>
                </div>

                <section class="p-4 mb-4" style="background-color: #1a1a1a; border-left: 4px solid #00ffff;">
                    <h3 class="h6 text-uppercase text-secondary fw-bold mb-3" style="letter-spacing: 2px;">
                        Registro Desclasificado
                    </h3>

                    <div class="lead" style="line-height: 1.8; color: #ccc;">
                        {!! nl2br(e($post->contenido)) !!}
                    </div>
                </section>

                <section class="mt-5 pt-4 border-top border-secondary">
                    <div class="row text-center text-secondary small">
                        <div class="col-6 border-end border-secondary">
                            AUTOR<br>
                            <b class="text-light">RETRO GAMES</b>
                        </div>

                        @auth
                            @if(Auth::user()->rol_fk == 1)
                                <div class="col-6">
                                    ESTADO<br>
                                    <b class="text-light">PÚBLICO</b>
                                </div>
                            @endif
                        @endauth
                    </div>
                </section>
            </section>
        </div>
    </article>
</x-principal-layout>
