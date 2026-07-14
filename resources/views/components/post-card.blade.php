<article class="card mb-4 vhs-card">
    <div class="row g-0">

        <div class="col-md-4 d-flex align-items-center p-2">
            @if($post->imagen !== null && \Storage::exists($post->imagen))
                <img
                    src="{{ \Storage::url($post->imagen) }}"
                    class="img-fluid rounded"
                    alt="{{ $post->imagen_descripcion ?? 'Imagen de la entrada ' . $post->titulo }}"
                >
            @else
                <img
                    src="{{ url('img/fallback-vhs.jpg') }}"
                    class="img-fluid rounded"
                    alt="Entrada sin imagen disponible"
                >
            @endif
        </div>

        <div class="col-md-8">
            <div class="card-body d-flex flex-column h-100 p-4">

                <h3 class="h4 card-title text-danger fw-bold">
                    {{ $post->titulo }}
                </h3>

                @if($post->subtitulo)
                    <p class="card-subtitle mb-2 text-warning">
                        {{ $post->subtitulo }}
                    </p>
                @endif

                <p class="card-text text-secondary mt-3 mb-4">
                    {{ \Illuminate\Support\Str::limit($post->contenido, 150) }}
                </p>

                <div class="d-flex flex-wrap gap-2 mt-auto">
                    <a href="{{ route('posts.leer', $post) }}" class="btn btn-vhs-cyan">
                        LEER MÁS
                    </a>

                    @auth
                        @if(Auth::user()->rol_fk == 1)
                            <a href="{{ route('posts.editar', $post) }}" class="btn btn-success fw-bold">
                                EDITAR
                            </a>

                            <a href="{{ route('posts.confirmar_eliminar', $post) }}" class="btn btn-danger fw-bold">
                                ELIMINAR
                            </a>
                        @endif
                    @endauth
                </div>

            </div>
        </div>
    </div>
</article>