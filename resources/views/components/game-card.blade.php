<div class="col-6 col-md-4 col-lg-3">
    <article class="card h-100 vhs-card">

        @if($juego->portada !== null && \Storage::exists($juego->portada))
            <img
                src="{{ \Storage::url($juego->portada) }}"
                class="card-img-top p-2"
                alt="{{ $juego->portada_descripcion ?? 'Portada del juego ' . $juego->titulo }}"
            >
        @else
            <img
                src="{{ url('img/cartucho-vacio.jpg') }}"
                class="card-img-top p-2"
                alt="Cartucho sin portada disponible"
            >
        @endif

        <div class="card-body d-flex flex-column">
            <h3 class="h5 card-title text-danger fw-bold">
                {{ $juego->titulo }}
            </h3>

            <p class="card-text small text-secondary">
                Año: {{ \Carbon\Carbon::parse($juego->fecha_lanzamiento)->format('Y') }}
            </p>

            <p class="card-text small mb-2">
                <span class="badge bg-warning text-black fw-bold">
                    {{ $juego->rating->abreviatura }}
                </span>
            </p>

            <div class="mb-2">
                @foreach($juego->generos as $genero)
                    <span class="badge bg-dark border border-warning text-warning mb-1">
                        {{ $genero->nombre }}
                    </span>
                @endforeach
            </div>

            <p class="mt-auto fw-bold text-light">
                ${{ number_format($juego->precio, 0, ',', '.') }}
            </p>

            <div class="d-flex flex-column gap-2 mt-2">
                <a href="{{ route('juegos.detalles', $juego) }}" class="btn btn-vhs-cyan w-100">
                    VER DETALLES
                </a>

                @auth
                    <form action="{{ route('carrito.agregar', $juego->slug) }}" method="post">
                        @csrf

                        <button type="submit" class="btn vhs-btn w-100">
                            COMPRAR
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="btn vhs-btn w-100">
                        COMPRAR
                    </a>
                @endauth

                @auth
                    @if(Auth::user()->rol_fk == 1)
                        <a href="{{ route('juegos.editar', $juego) }}" class="btn btn-success w-100 fw-bold">
                            EDITAR
                        </a>

                        <a href="{{ route('juegos.confirmar_eliminar', $juego) }}" class="btn btn-danger w-100 fw-bold">
                            ELIMINAR
                        </a>
                    @endif
                @endauth
            </div>
        </div>
    </article>
</div>