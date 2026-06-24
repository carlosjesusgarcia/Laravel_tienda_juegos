<x-principal-layout>
    <x-slot:title>Editar Entrada</x-slot:title>

    <section class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8">

                <a href="{{ route('posts.listado') }}" class="btn btn-outline-danger btn-sm mb-3">
                    VOLVER AL BLOG
                </a>

                <section class="card bg-black border-success shadow-lg">
                    <div class="card-header border-success bg-dark">
                        <h1 class="h2 text-success fw-bold stranger-text mb-0 py-2">
                            > MODIFICAR REGISTRO DESCLASIFICADO
                        </h1>
                    </div>

                    <div class="card-body p-4">
                        <x-formulario-post :post="$post" />
                    </div>
                </section>

            </div>
        </div>
    </section>
</x-principal-layout>
