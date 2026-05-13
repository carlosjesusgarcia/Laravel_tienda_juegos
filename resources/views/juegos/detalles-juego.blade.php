<x-principal-layout>
    <x-slot:title>Expediente: {{ $juego->titulo }}</x-slot:title>

    <div class="container py-5">
        <div class="mb-4">
            <a href="{{ route('juegos.listado') }}" class="btn btn-vhs-yellow">
                <i class="bi bi-arrow-left"></i> [ VOLVER AL ARCHIVO ]
            </a>
        </div>

        <div class="row g-5">
            <div class="col-md-5">
                <div class="vhs-card p-3 shadow-lg">

                    {{--
                     |--------------------------------------------------------------------------
                     | Lógica de Visualización de Imagen (Adaptada del Profesor)
                     |--------------------------------------------------------------------------
                     | Siguiendo la referencia, solo mostramos la etiqueta <img> si:
                     | 1. El campo 'portada' en la DB no es NULL.
                     | 2. El archivo físico existe en el disco usando Storage::exists().
                     |
                     | Nota: Se asume que tus columnas en la DB se llaman 'portada'
                     | y 'portada_descripcion' basadas en los pasos anteriores.
                     --}}
                    @if($juego->portada !== null && \Storage::exists($juego->portada))
                        <img
                            {{-- Generamos la URL pública con Storage::url() --}}
                            src="{{ \Storage::url($juego->portada) }}"
                            class="img-fluid w-100"
                            {{-- Usamos la descripción dinámica para accesibilidad --}}
                            alt="{{ $juego->portada_descripcion }}"
                            {{-- Mantenemos tus filtros de estilo VHS --}}
                            style="filter: grayscale(0.2) contrast(1.2);"
                        >
                    @endif

                    <div class="mt-3 text-center">
                        <span class="badge bg-danger text-black fw-bold px-3 py-2">
                            ESTADO: DISPONIBLE
                        </span>
                    </div>
                </div>
            </div>

            <div class="col-md-7">
                <h1 class="display-3 fw-bold text-uppercase mb-2" style="color: #ff3355; text-shadow: 0 0 10px rgba(255, 51, 85, 0.6);">
                    {{ $juego->titulo }}
                </h1>

                <div class="d-flex align-items-center gap-3 mb-4">
                    <span class="text-secondary fw-bold">LANZAMIENTO: {{ $juego->fecha_lanzamiento }}</span>
                    <span class="text-info fw-bold">ID: #{{ str_pad($juego->id, 4, '0', STR_PAD_LEFT) }}</span>
                </div>

                <div class="p-4 mb-4" style="background-color: #1a1a1a; border-left: 4px solid #ff8800;">
                    <h3 class="h6 text-uppercase text-secondary fw-bold mb-3" style="letter-spacing: 2px;">
                        Sinopsis del sistema
                    </h3>
                    <p class="lead" style="line-height: 1.8; color: #ccc;">
                        {{ $juego->sinopsis ?? 'No hay datos adicionales sobre este cartucho en la base de datos central.' }}
                    </p>
                </div>

                <div class="row align-items-center mt-5">
                    <div class="col-sm-6">
                        <div class="h1 fw-bold text-white mb-0">
                            ${{ number_format($juego->precio / 100, 2) }}
                        </div>
                        <small class="text-secondary text-uppercase">Tarifa de alquiler por 48h</small>
                    </div>
                    <div class="col-sm-6 mt-3 mt-sm-0">
                        <button class="btn vhs-btn btn-lg w-100 py-3">
                            <i class="bi bi-cart-plus"></i> COMPRALO AHORA
                        </button>
                    </div>
                </div>

                <div class="mt-5 pt-4 border-top border-secondary">
                    <div class="row text-center text-secondary small">
                        <div class="col-4 border-end border-secondary">FORMATO<br><b class="text-light">NTSC</b></div>
                        <div class="col-4 border-end border-secondary">GÉNERO<br><b class="text-light">RETRO-GAME</b></div>
                        <div class="col-4">COPIAS<br><b class="text-light">LIMITADAS</b></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-principal-layout>
