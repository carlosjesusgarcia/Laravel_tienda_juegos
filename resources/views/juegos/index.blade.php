<x-principal-layout>
    <x-slot:title>Catálogo de Juegos</x-slot:title>

    <h1 class="display-4 fw-bold text-danger text-center mb-5">
        CATÁLOGO DE RETRO GAMES
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

    <section class="mb-5 p-4 border border-secondary rounded">
        <h2 class="h4 text-warning mb-4">
            Filtrar catálogo
        </h2>

        <form action="{{ route('juegos.listado') }}" method="get">
            <div class="row g-3 align-items-end">
                <div class="col-md-5">
                    <label for="s-clasificacion" class="form-label text-light">
                        Ver por edad
                    </label>

                    <select name="s-clasificacion" id="s-clasificacion" class="form-select">
                        <option value="">Todas las edades</option>

                        @foreach($clasificaciones as $clasificacion)
                            <option value="{{ $clasificacion->rating_id }}"
                                @if($parametrosBusqueda['s-clasificacion'] == $clasificacion->rating_id) selected @endif>
                                {{ $clasificacion->nombre }} ({{ $clasificacion->abreviatura }})
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-5">
                    <label for="s-genero" class="form-label text-light">
                        Ver por género
                    </label>

                    <select name="s-genero" id="s-genero" class="form-select">
                        <option value="">Todos los géneros</option>

                        @foreach($generos as $genero)
                            <option value="{{ $genero->genero_id }}"
                                @if($parametrosBusqueda['s-genero'] == $genero->genero_id) selected @endif>
                                {{ $genero->nombre }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-2">
                    <button type="submit" class="btn btn-vhs-cyan w-100 fw-bold">
                        Filtrar
                    </button>
                </div>
            </div>

            <div class="mt-3">
                <a href="{{ route('juegos.listado') }}" class="text-secondary">
                    Limpiar filtros
                </a>
            </div>
        </form>
    </section>

    <div class="row g-4">
        @forelse ($juegos as $juego)
            <x-game-card :juego="$juego" />
        @empty
            <div class="col-12 text-center">
                <p class="text-secondary">
                    No hay juegos disponibles para esos filtros.
                </p>
            </div>
        @endforelse
    </div>
</x-principal-layout>
