<x-principal-layout>
    <x-slot:title>Detalle de Usuario</x-slot:title>

    <h1 class="display-4 fw-bold text-danger text-center mb-5">
        DETALLE DE USUARIO
    </h1>

    <p class="text-center text-secondary mb-5">
        Información de la cuenta registrada y sus compras asociadas.
    </p>

    <section class="mb-5 p-4 border border-secondary rounded">
        <h2 class="h4 text-warning mb-4">
            Datos del usuario
        </h2>

        <dl class="row text-light mb-0">
            <dt class="col-md-3 text-warning">Nombre</dt>
            <dd class="col-md-9">{{ $usuario->name }}</dd>

            <dt class="col-md-3 text-warning">Email</dt>
            <dd class="col-md-9">{{ $usuario->email }}</dd>

            <dt class="col-md-3 text-warning">Rol</dt>
            <dd class="col-md-9">{{ $usuario->rol->nombre }}</dd>

            <dt class="col-md-3 text-warning">Fecha de registro</dt>
            <dd class="col-md-9">{{ $usuario->created_at }}</dd>
        </dl>
    </section>

    <section class="mb-5 p-4 border border-secondary rounded">
        <h2 class="h4 text-warning mb-4">
            Compras realizadas
        </h2>

        @if($usuario->compras->isNotEmpty())
            <div class="table-responsive">
                <table class="table table-dark table-bordered border-secondary align-middle mb-0">
                    <thead>
                        <tr>
                            <th>Juego</th>
                            <th>Fecha</th>
                            <th>Precio</th>
                            <th>Estado</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($usuario->compras as $compra)
                            <tr>
                                <td>{{ $compra->juego->titulo }}</td>
                                <td>{{ $compra->fecha_compra->format('d/m/Y') }}</td>
                                <td>${{ $compra->precio }}</td>
                                <td>{{ $compra->estado }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <p class="text-secondary mb-0">
                Este usuario no tiene compras registradas.
            </p>
        @endif
    </section>

    <div class="text-center">
        <a href="{{ route('admin.usuarios.index') }}" class="text-secondary">
            Volver al listado de usuarios
        </a>
    </div>
</x-principal-layout>
