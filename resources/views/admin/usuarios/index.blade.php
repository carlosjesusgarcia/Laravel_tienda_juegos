<x-principal-layout>
    <x-slot:title>Usuarios Registrados</x-slot:title>

    <h1 class="display-4 fw-bold text-danger text-center mb-5">
        USUARIOS REGISTRADOS
    </h1>

    <p class="text-center text-secondary mb-5">
        Listado de cuentas registradas en Retro Games.
    </p>

    <section class="mb-5 p-4 border border-secondary rounded">
        <h2 class="h4 text-warning mb-4">
            Archivo de usuarios
        </h2>

        <div class="table-responsive">
            <table class="table table-dark table-bordered border-secondary align-middle mb-0">
                <thead>
                    <tr>
                        <th scope="col">Usuario</th>
                        <th scope="col">Email</th>
                        <th scope="col">Rol</th>
                        <th scope="col">Detalle</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($usuarios as $usuario)
                        <tr>
                            <td>{{ $usuario->name }}</td>
                            <td>{{ $usuario->email }}</td>
                            <td>{{ $usuario->rol->nombre }}</td>
                            <td>
                                <a
                                    href="{{ route('admin.usuarios.detalles', $usuario->id) }}"
                                    class="btn btn-vhs-cyan fw-bold btn-sm"
                                >
                                    [ VER ]
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center text-secondary">
                                No hay usuarios registrados.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>

    <div class="text-center">
        <a href="{{ route('admin.index') }}" class="text-secondary">
            Volver al panel de administración
        </a>
    </div>
</x-principal-layout>