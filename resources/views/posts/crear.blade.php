<x-principal-layout>
    <x-slot:title>Nueva Entrada</x-slot:title>

    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8">

                <a href="{{ route('posts.listado') }}" class="btn btn-outline-danger btn-sm mb-3">
                    VOLVER AL BLOG
                </a>

                <div class="card bg-black border-danger shadow-lg">
                    <div class="card-header border-danger bg-dark">
                        <h2 class="text-danger fw-bold stranger-text mb-0 py-2">
                            > REDACTAR NUEVA ENTRADA
                        </h2>
                    </div>
                    <div class="card-body p-4">

                        <x-formulario-post />
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-principal-layout>
