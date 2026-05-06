@props(['juego'])

<div class="col-6 col-md-4 col-lg-3">
    <div class="card h-100 vhs-card">

        <img
            src="https://via.placeholder.com/200x300/111/f00?text={{ urlencode($juego->titulo) }}"
            class="card-img-top p-2"
            alt="Portada de {{ $juego->titulo }}"
        >

        <div class="card-body d-flex flex-column bg-black">

            <h5 class="card-title text-danger fw-bold">
                {{ $juego->titulo }}
            </h5>

            <p class="card-text small text-secondary">
                Año: {{ \Carbon\Carbon::parse($juego->fecha_lanzamiento)->format('Y') }}
            </p>

            <p class="mt-auto fw-bold text-light">
                ${{ number_format($juego->precio / 100, 2) }}
            </p>

            {{--
             |--------------------------------------------------------------------------
             | Acciones de la Tarjeta
             |--------------------------------------------------------------------------
             | Agrupa los controles de navegación y administración del registro.
             --}}
            <div class="d-flex flex-column gap-2 mt-2">

                {{-- Navegación a la vista de detalle (Pública) --}}
                <a href="{{ route('juegos.detalles', $juego) }}" class="btn btn-vhs-cyan w-100">
                    VER DETALLES
                </a>

                {{-- Acción temporal (Pendiente de implementación) (Pública) --}}
                <a href="#" class="btn vhs-btn w-100">
                    COMPRAR
                </a>

                {{-- Controles de Administración ocultos para invitados --}}
                @auth
                    {{--
                     | Acción de Edición
                     | Permite acceder al formulario de modificación del registro existente.
                     --}}
                    <a href="{{ route('juegos.editar', $juego) }}" class="btn btn-success w-100 fw-bold">
                        EDITAR
                    </a>

                    {{--
                     | Acción de Eliminación (Navegación a Confirmación)
                     | Redirige a una vista intermedia HTTP GET para validar la intención del usuario
                     | y prevenir borrados accidentales.
                     --}}
                    <a href="{{ route('juegos.confirmar_eliminar', $juego) }}" class="btn btn-danger w-100 fw-bold">
                        ELIMINAR
                    </a>

                    {{--
                     | Acción de Eliminación Directa (Comentada)
                     | Se desactiva el envío directo por POST en favor del paso intermedio de confirmación.
                     |
                    <form action="{{ route('juegos.eliminar', $juego) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-danger w-100 fw-bold">
                            ELIMINAR
                        </button>
                    </form>
                     --}}
                @endauth
            </div>

        </div>
    </div>
</div>
