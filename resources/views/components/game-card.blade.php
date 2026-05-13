{{--
/**
 * Archivo: tarjeta-juego.blade.php
 * Función: Componente de interfaz encargado de renderizar de forma modular la información básica de un juego en las grillas del catálogo.
 *
 * @var \App\Models\Juego $juego Instancia del modelo que contiene los atributos de identificación, precio y recursos multimedia.
 */
--}}
@props(['juego'])

<div class="col-6 col-md-4 col-lg-3">
    <div class="card h-100 vhs-card">

        @if($juego->portada !== null && \Storage::exists($juego->portada))
            <img
                src="{{ \Storage::url($juego->portada) }}"
                class="card-img-top p-2"
                alt="{{ $juego->portada_descripcion }}"
            >
        @else
            <img
                src="{{ url('img/cartucho-vacio.jpg') }}"
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
                ${{ number_format($juego->precio, 0, ',', '.') }}
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
