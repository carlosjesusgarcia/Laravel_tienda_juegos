<x-principal-layout>
    <x-slot:title>Nuevo Cartucho</x-slot:title>

    <section
        class="container py-5"
        aria-labelledby="titulo-nuevo-cartucho"
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
                            id="titulo-nuevo-cartucho"
                            class="h2 text-danger fw-bold stranger-text mb-0 py-2"
                        >
                            &gt; REGISTRAR NUEVA ENTRADA
                        </h1>
                    </div>

                    <div class="card-body p-4">
                        <x-formulario-juego
                            :ratings="$ratings"
                            :generos="$generos"
                        />
                    </div>
                </div>

            </div>
        </div>
    </section>
</x-principal-layout>