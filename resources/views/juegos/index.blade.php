<x-principal-layout>
    <x-slot:title>Catálogo de Juegos</x-slot:title>

    <h1 class="display-4 fw-bold text-danger text-center mb-5">
        CATÁLOGO DEL MUNDO DEL REVÉS
    </h1>

    <p class="text-center text-secondary mb-5">
        Elige tus cartuchos bajo tu propio riesgo.
    </p>

    {{-- @auth restringe la vista del botón de creación solo a administradores logueados --}}
    @auth
        <div class="text-center mb-5">
            <a href="{{ route('juegos.crear') }}" class="btn btn-vhs-cyan fw-bold px-4">
                [ REGISTRAR NUEVO JUEGO ]
            </a>
        </div>
    @endauth

    <div class="row g-4">
        @forelse ($juegos as $juego)
            <x-game-card :juego="$juego" />
        @empty
            <div class="col-12 text-center">
                <p class="text-secondary">
                    No hay juegos disponibles.
                </p>
            </div>
        @endforelse
    </div>
</x-principal-layout>
