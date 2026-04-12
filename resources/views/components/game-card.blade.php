@props([
    'imagen',
    'alt' => 'Portada del juego',
    'titulo',
    'categoria',
    'precio',
    'enlace' => '#',
    'boton' => 'Alquilar',
])

<div class="col-6 col-md-4 col-lg-3">
    <div class="card h-100 vhs-card">
        <img src="{{ $imagen }}" class="card-img-top p-2" alt="{{ $alt }}">

        <div class="card-body d-flex flex-column bg-black">
            <h5 class="card-title text-danger fw-bold">{{ $titulo }}</h5>
            <p class="card-text small text-secondary">{{ $categoria }}</p>
            <p class="mt-auto fw-bold text-light">{{ $precio }}</p>

            <a href="{{ $enlace }}" class="btn vhs-btn w-100 mt-2">
                {{ $boton }}
            </a>
        </div>
    </div>
</div>
