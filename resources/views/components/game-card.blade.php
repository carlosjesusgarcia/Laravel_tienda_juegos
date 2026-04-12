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

            {{--
                CAMBIO AQUÍ:
                Usamos \Carbon\Carbon::parse() para convertir el string en fecha
            --}}
            <p class="card-text small text-secondary">
                Año: {{ \Carbon\Carbon::parse($juego->fecha_lanzamiento)->format('Y') }}
            </p>

            <p class="mt-auto fw-bold text-light">
                ${{ number_format($juego->precio / 100, 2) }}
            </p>

            <a href="#" class="btn vhs-btn w-100 mt-2">
                ALQUILAR
            </a>

        </div>
    </div>
</div>
