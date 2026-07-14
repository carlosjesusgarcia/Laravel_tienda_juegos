<x-principal-layout>
    <x-slot:title>Mi Perfil</x-slot:title>

    <h1 class="display-4 fw-bold text-danger text-center mb-4">
        MI PERFIL
    </h1>

    <p class="text-center text-secondary mb-5">
        Consultá los datos de tu cuenta y las compras que realizaste en Retro Games.
    </p>

    <section
        class="mb-5 p-4 border border-secondary rounded"
        aria-labelledby="titulo-datos-personales"
    >
        <h2
            id="titulo-datos-personales"
            class="h4 text-warning mb-4"
        >
            Datos personales
        </h2>

        <dl class="row text-light mb-4">
            <dt class="col-md-3 text-warning">Nombre</dt>
            <dd class="col-md-9">{{ $usuario->name }}</dd>

            <dt class="col-md-3 text-warning">Correo electrónico</dt>
            <dd class="col-md-9">{{ $usuario->email }}</dd>

            <dt class="col-md-3 text-warning">Rol</dt>
            <dd class="col-md-9">{{ $usuario->rol->nombre }}</dd>

            <dt class="col-md-3 text-warning">Fecha de registro</dt>
            <dd class="col-md-9">
                {{ $usuario->created_at->format('d/m/Y') }}
            </dd>
        </dl>

        <a
            href="{{ route('perfil.editar') }}"
            class="btn btn-vhs-cyan fw-bold"
        >
            [ EDITAR PERFIL ]
        </a>
    </section>

    <section
        class="p-4 border border-secondary rounded"
        aria-labelledby="titulo-historial-compras"
    >
        <h2
            id="titulo-historial-compras"
            class="h4 text-warning mb-4"
        >
            Historial de compras
        </h2>

        @if($usuario->compras->isNotEmpty())
            <div class="table-responsive">
                <table class="table table-dark table-bordered border-secondary align-middle mb-0">
                    <caption class="visually-hidden">
                        Compras realizadas por {{ $usuario->name }}
                    </caption>

                    <thead>
                        <tr>
                            <th scope="col">Número</th>
                            <th scope="col">Fecha</th>
                            <th scope="col">Juegos</th>
                            <th scope="col">Total</th>
                            <th scope="col">Estado</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($usuario->compras as $compra)
                            <tr>
                                <th scope="row">
                                    {{ $compra->compra_id }}
                                </th>

                                <td>
                                    {{ $compra->fecha_compra->format('d/m/Y') }}
                                </td>

                                <td>
                                    <ul class="mb-0">
                                        @foreach($compra->detalles as $detalle)
                                            <li>
                                                {{ $detalle->descripcion }}
                                                — Cantidad: {{ $detalle->cantidad }}
                                                — ${{ number_format($detalle->precio_unitario, 2, ',', '.') }}
                                            </li>
                                        @endforeach
                                    </ul>
                                </td>

                                <td>
                                    ${{ number_format($compra->total, 2, ',', '.') }}
                                </td>

                                <td>
                                    {{ ucfirst($compra->estado) }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <p class="text-secondary mb-0">
                Todavía no tenés compras registradas.
            </p>
        @endif
    </section>
</x-principal-layout>