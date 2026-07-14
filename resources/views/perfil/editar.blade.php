<x-principal-layout>
    <x-slot:title>Editar Perfil</x-slot:title>

    <section
        class="container py-5"
        aria-labelledby="titulo-editar-perfil"
    >
        <div class="row justify-content-center">
            <div class="col-md-8">
                <a
                    href="{{ route('perfil.index') }}"
                    class="btn btn-outline-danger btn-sm mb-3"
                >
                    VOLVER A MI PERFIL
                </a>

                <div class="card border-danger shadow-lg">
                    <div class="card-header border-danger bg-dark">
                        <h1
                            id="titulo-editar-perfil"
                            class="h2 text-danger fw-bold stranger-text mb-0 py-2"
                        >
                            &gt; ACTUALIZAR DATOS DEL PERFIL
                        </h1>
                    </div>

                    <div class="card-body p-4">
                        <form
                            action="{{ route('perfil.actualizar') }}"
                            method="post"
                            novalidate
                        >
                            @csrf
                            @method('PUT')

                            <div class="mb-4">
                                <label
                                    for="name"
                                    class="form-label text-warning"
                                >
                                    Nombre
                                </label>

                                <input
                                    type="text"
                                    id="name"
                                    name="name"
                                    value="{{ old('name', $usuario->name) }}"
                                    class="form-control"
                                    autocomplete="name"
                                >

                                @error('name')
                                    <p class="text-danger mt-2 mb-0">
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label
                                    for="email"
                                    class="form-label text-warning"
                                >
                                    Correo electrónico
                                </label>

                                <input
                                    type="email"
                                    id="email"
                                    name="email"
                                    value="{{ old('email', $usuario->email) }}"
                                    class="form-control"
                                    autocomplete="email"
                                >

                                @error('email')
                                    <p class="text-danger mt-2 mb-0">
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            <button
                                type="submit"
                                class="btn btn-vhs-cyan fw-bold"
                            >
                                [ GUARDAR CAMBIOS ]
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-principal-layout>