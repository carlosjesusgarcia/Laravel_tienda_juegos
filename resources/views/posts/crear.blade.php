<x-principal-layout>
    <x-slot:title>Nueva Entrada</x-slot:title>

    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8">

                <a
                    href="{{ route('posts.listado') }}"
                    class="btn btn-outline-danger btn-sm mb-3"
                >
                    VOLVER AL BLOG
                </a>

                <section
                    class="card border-danger shadow-lg"
                    aria-labelledby="titulo-nueva-entrada"
                >
                    <div class="card-header border-danger bg-dark">
                        <h1
                            id="titulo-nueva-entrada"
                            class="h2 text-danger fw-bold stranger-text mb-0 py-2"
                        >
                            &gt; REDACTAR NUEVA ENTRADA
                        </h1>
                    </div>

                    <div class="card-body p-4">
                        <x-formulario-post />
                    </div>
                </section>

            </div>
        </div>
    </div>
</x-principal-layout>