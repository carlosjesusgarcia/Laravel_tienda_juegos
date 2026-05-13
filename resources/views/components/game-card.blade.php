@props(['juego'])

<div class="col-6 col-md-4 col-lg-3">
    <div class="card h-100 vhs-card">

        {{--
         | Lógica adaptada al estándar del profesor:
         | 1. Verificamos que el campo no sea nulo.
         | 2. Verificamos que el archivo exista físicamente en el disco con Storage::exists().
         --}}
        @if($juego->portada !== null && \Storage::exists($juego->portada))
            <img
                {{-- Usamos la fachada Storage para generar la URL correcta --}}
                src="{{ \Storage::url($juego->portada) }}"
                class="card-img-top p-2"
                alt="{{ $juego->portada_descripcion }}"
            >
        @else
            {{-- Fallback: Imagen por defecto si no pasa las validaciones anteriores --}}
            <img
                src="{{ url('img/fallback-vhs.jpg') }}"
                class="card-img-top p-2"
                alt="Cartucho sin portada disponible"
            >
        @endif

        <div class="card-body d-flex flex-column bg-black">
            <h5 class="card-title text-danger fw-bold">
                {{ $juego->titulo }}
            </h5>

            <p class="card-text small text-secondary">
                Año: {{ \Carbon\Carbon::parse($juego->fecha_lanzamiento)->format('Y') }}
            </p>

            <p class="mt-auto fw-bold text-light">
                ${{ number_format($juego->precio, 2) }}
            </p>

            <div class="d-flex flex-column gap-2 mt-2">
                <a href="{{ route('juegos.detalles', $juego) }}" class="btn btn-vhs-cyan w-100">
                    VER DETALLES
                </a>

                <a href="#" class="btn vhs-btn w-100">
                    COMPRAR
                </a>

                @auth
                    <a href="{{ route('juegos.editar', $juego) }}" class="btn btn-success w-100 fw-bold">
                        EDITAR
                    </a>

                    <a href="{{ route('juegos.confirmar_eliminar', $juego) }}" class="btn btn-danger w-100 fw-bold">
                        ELIMINAR
                    </a>
                @endauth
            </div>
        </div>
    </div>
</div>
