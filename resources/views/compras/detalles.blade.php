<x-principal-layout>
    <x-slot:title>Pedido #{{ $compra->compra_id }}</x-slot:title>

    <section
        class="container py-5"
        aria-labelledby="titulo-detalle-pedido"
    >
        <div class="mb-4">
            <a
                href="{{ route('compras.index') }}"
                class="btn btn-vhs-yellow"
            >
                <i class="bi bi-arrow-left" aria-hidden="true"></i>
                [ VOLVER A MIS COMPRAS ]
            </a>
        </div>

        <h1
            id="titulo-detalle-pedido"
            class="display-3 fw-bold text-uppercase mb-2"
            style="color: #ff3355; text-shadow: 0 0 10px rgba(255, 51, 85, 0.6);"
        >
            Detalle del pedido
        </h1>

        <div class="d-flex align-items-center gap-3 mb-5">
            <span class="text-secondary fw-bold">
                NÚMERO: #{{ $compra->compra_id }}
            </span>

            <span class="badge bg-warning text-black fw-bold">
                {{ strtoupper($compra->estado) }}
            </span>
        </div>

        <div class="row g-5">
            <section
                class="col-md-5"
                aria-labelledby="titulo-resumen-pedido"
            >
                <div class="vhs-card p-4 shadow-lg">
                    <h2
                        id="titulo-resumen-pedido"
                        class="h3 text-danger fw-bold text-uppercase mb-4"
                    >
                        Pedido #{{ $compra->compra_id }}
                    </h2>

                    <dl class="mb-0">
                        <dt class="text-secondary text-uppercase">
                            Comprador
                        </dt>

                        <dd class="text-light fw-bold mb-3">
                            {{ $compra->usuario->name }}
                        </dd>

                        <dt class="text-secondary text-uppercase">
                            Correo electrónico
                        </dt>

                        <dd class="text-light fw-bold mb-3">
                            {{ $compra->usuario->email }}
                        </dd>

                        <dt class="text-secondary text-uppercase">
                            Fecha de compra
                        </dt>

                        <dd class="text-light fw-bold mb-3">
                            {{ $compra->fecha_compra->format('d/m/Y') }}
                        </dd>

                        <dt class="text-secondary text-uppercase">
                            Cantidad de cartuchos
                        </dt>

                        <dd class="text-light fw-bold mb-0">
                            {{ $compra->detalles->sum('cantidad') }}
                        </dd>
                    </dl>

                    <div class="mt-4 text-center">
                        <span class="badge bg-warning text-black fw-bold px-3 py-2">
                            ESTADO: {{ strtoupper($compra->estado) }}
                        </span>
                    </div>
                </div>
            </section>

            <div class="col-md-7">
                <section
                    class="p-4 mb-4"
                    aria-labelledby="titulo-cartuchos-incluidos"
                    style="background-color: #1a1a1a; border-left: 4px solid #ff8800;"
                >
                    <h2
                        id="titulo-cartuchos-incluidos"
                        class="text-uppercase text-secondary fw-bold mb-4"
                        style="letter-spacing: 2px;"
                    >
                        Cartuchos incluidos
                    </h2>

                    @foreach($compra->detalles as $detalle)
                        <article
                            class="pb-4 mb-4 border-bottom border-secondary"
                            aria-labelledby="titulo-detalle-{{ $detalle->compra_juego_id }}"
                        >
                            <div class="row align-items-center g-3">
                                @if(
                                    $detalle->juego !== null &&
                                    $detalle->juego->portada !== null &&
                                    \Storage::exists($detalle->juego->portada)
                                )
                                    <div class="col-sm-3">
                                        <img
                                            src="{{ \Storage::url($detalle->juego->portada) }}"
                                            class="img-fluid w-100"
                                            alt="{{ $detalle->juego->portada_descripcion ?? 'Portada del juego ' . $detalle->descripcion }}"
                                            style="filter: grayscale(0.2) contrast(1.2);"
                                        >
                                    </div>
                                @endif

                                <div class="col">
                                    <h3
                                        id="titulo-detalle-{{ $detalle->compra_juego_id }}"
                                        class="h4 text-danger fw-bold text-uppercase mb-3"
                                    >
                                        {{ $detalle->descripcion }}
                                    </h3>

                                    <div class="row g-3">
                                        <div class="col-sm-4">
                                            <span class="text-secondary small text-uppercase">
                                                Precio unitario
                                            </span>

                                            <p class="text-light fw-bold mb-0">
                                                ${{ number_format($detalle->precio_unitario, 0, ',', '.') }}
                                            </p>
                                        </div>

                                        <div class="col-sm-4">
                                            <span class="text-secondary small text-uppercase">
                                                Cantidad
                                            </span>

                                            <p class="text-light fw-bold mb-0">
                                                {{ $detalle->cantidad }}
                                            </p>
                                        </div>

                                        <div class="col-sm-4">
                                            <span class="text-secondary small text-uppercase">
                                                Subtotal
                                            </span>

                                            <p class="text-warning fw-bold mb-0">
                                                ${{ number_format(
                                                    $detalle->precio_unitario * $detalle->cantidad,
                                                    0,
                                                    ',',
                                                    '.'
                                                ) }}
                                            </p>
                                        </div>
                                    </div>

                                    @if($detalle->juego !== null)
                                        <a
                                            href="{{ route('juegos.detalles', $detalle->juego) }}"
                                            class="btn btn-vhs-yellow btn-sm mt-3"
                                        >
                                            [ VER EXPEDIENTE ]
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </article>
                    @endforeach
                </section>

                <div class="row align-items-center mt-5">
                    <div class="col-sm-6">
                        <p class="h1 fw-bold text-white mb-0">
                            ${{ number_format($compra->total, 0, ',', '.') }}
                        </p>

                        <small class="text-secondary text-uppercase">
                            Total del pedido
                        </small>
                    </div>

                    <div class="col-sm-6 mt-3 mt-sm-0">
                        <div class="vhs-btn text-center w-100 py-3">
                            <i
                                class="bi bi-envelope-check"
                                aria-hidden="true"
                            ></i>
                            COMPROBANTE ENVIADO
                        </div>
                    </div>
                </div>

                <div class="mt-5 pt-4 border-top border-secondary">
                    <div class="row text-center text-secondary small">
                        <div class="col-4 border-end border-secondary">
                            PEDIDO<br>
                            <strong class="text-light">
                                #{{ $compra->compra_id }}
                            </strong>
                        </div>

                        <div class="col-4 border-end border-secondary">
                            ESTADO<br>
                            <strong class="text-light">
                                {{ strtoupper($compra->estado) }}
                            </strong>
                        </div>

                        <div class="col-4">
                            COMPROBANTE<br>
                            <strong class="text-light">
                                EMAIL
                            </strong>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-principal-layout>