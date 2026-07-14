<x-principal-layout>
    <x-slot:title>Editar Cartucho: {{ $juego->titulo }}</x-slot:title>

    <section
        class="container py-5"
        aria-labelledby="titulo-editar-cartucho"
    >
        <div class="row justify-content-center">
            <div class="col-md-8">

                <a
                    href="{{ route('juegos.listado') }}"
                    class="btn btn-outline-danger btn-sm mb-3"
                >
                    VOLVER AL CATÁLOGO
                </a>

                <div class="card border-danger shadow-lg">
                    <div class="card-header border-danger bg-dark">
                        <h1
                            id="titulo-editar-cartucho"
                            class="h2 text-danger fw-bold stranger-text mb-0 py-2"
                        >
                            &gt; ACTUALIZAR ENTRADA DEL ARCHIVO
                        </h1>
                    </div>

                    <div class="card-body p-4">
                        <x-form-editar-juego
                            :juego="$juego"
                            :ratings="$ratings"
                            :generos="$generos"
                        />
                    </div>
                </div>

            </div>
        </div>
    </section>
</x-principal-layout>