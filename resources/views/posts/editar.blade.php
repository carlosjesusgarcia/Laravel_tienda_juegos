<x-principal-layout>
    <x-slot:title>Editar Entrada</x-slot:title>

    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8">

                <div class="mb-4">
                    <a
                        href="{{ route('posts.listado') }}"
                        class="btn btn-vhs-yellow"
                    >
                        <i class="bi bi-arrow-left" aria-hidden="true"></i>
                        [ VOLVER ]
                    </a>
                </div>

                <section
                    class="card border-success shadow-lg"
                    aria-labelledby="titulo-editar-entrada"
                >
                    <div class="card-header border-success bg-dark">
                        <h1
                            id="titulo-editar-entrada"
                            class="h2 text-success fw-bold stranger-text mb-0 py-2"
                        >
                            &gt; MODIFICAR REGISTRO DESCLASIFICADO
                        </h1>
                    </div>

                    <div class="card-body p-4">
                        <x-formulario-post :post="$post" />
                    </div>
                </section>

            </div>
        </div>
    </div>
</x-principal-layout>