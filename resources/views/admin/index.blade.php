<x-principal-layout>
    <x-slot:title>Panel de Administración</x-slot:title>

    <h1 class="display-4 fw-bold text-danger text-center mb-5">
        PANEL DE ADMINISTRACIÓN
    </h1>

    <p class="text-center text-secondary mb-5">
        Sector restringido para gestionar los contenidos principales de Retro Games.
    </p>

    <section class="mb-5 p-4 border border-secondary rounded">
        <h2 class="h4 text-warning mb-4">
            Accesos rápidos
        </h2>

        <div class="row g-4">
            <div class="col-md-4">
                <a
                    href="{{ route('juegos.crear') }}"
                    class="btn btn-vhs-cyan w-100 fw-bold"
                >
                    [ REGISTRAR NUEVO JUEGO ]
                </a>
            </div>

            <div class="col-md-4">
                <a
                    href="{{ route('posts.crear') }}"
                    class="btn btn-vhs-cyan w-100 fw-bold"
                >
                    [ PUBLICAR NUEVA ENTRADA ]
                </a>
            </div>

            <div class="col-md-4">
                <a
                    href="{{ route('admin.usuarios.index') }}"
                    class="btn btn-vhs-cyan w-100 fw-bold"
                >
                    [ VER USUARIOS ]
                </a>
            </div>
        </div>
    </section>

    <section class="p-4 border border-secondary rounded">
        <h2 class="h4 text-warning mb-4">
            Administración del sitio
        </h2>

        <p class="text-secondary mb-0">
            Desde este panel el administrador puede acceder a la gestión de juegos,
            publicaciones del blog y usuarios registrados.
        </p>
    </section>
</x-principal-layout>