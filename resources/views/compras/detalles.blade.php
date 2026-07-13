<x-principal-layout>
    <x-slot:title>Pedido #{{ $compra->compra_id }}</x-slot:title>

    <article class="container py-5">
        <div class="mb-4">
            <a href="{{ route('compras.index') }}" class="btn btn-vhs-yellow">
                <i class="bi bi-arrow-left"></i> [ VOLVER A MIS COMPRAS ]
            </a>
        </div>

        <div class="row g-5">
            <section class="col-md-5">
                <div class="vhs-card p-4 shadow-lg">
                    <h2 class="h3 text-danger fw-bold text-uppercase mb-4">
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

            <section class="col-md-7">
                <h1
                    class="display-3 fw-bold text-uppercase mb-2"
                    style="color: #ff3355; text-shadow: 0 0 10px rgba(255, 51, 85, 0.6);"
                >
                    Detalle del pedido
                </h1>

                <div class="d-flex align-items-center gap-3 mb-4">
                    <span class="text-secondary fw-bold">
                        NÚMERO: #{{ $compra->compra_id }}
                    </span>

                    <span class="badge bg-warning text-black fw-bold">
                        {{ strtoupper($compra->estado) }}
                    </span>
                </div>

                <section
                    class="p-4 mb-4"
                    style="background-color: #1a1a1a; border-left: 4px solid #ff8800;"
                >
                    <h2
                        class="h2 text-uppercase text-secondary fw-bold mb-4"
                        style="letter-spacing: 2px;"
                    >
                        Cartuchos incluidos
                    </h2>

                    @foreach($compra->detalles as $detalle)
                        <article class="pb-4 mb-4 border-bottom border-secondary">
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
                                    <h3 class="h4 text-danger fw-bold text-uppercase mb-3">
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

                <section class="row align-items-center mt-5">
                    <div class="col-sm-6">
                        <div class="h1 fw-bold text-white mb-0">
                            ${{ number_format($compra->total, 0, ',', '.') }}
                        </div>

                        <small class="text-secondary text-uppercase">
                            Total del pedido
                        </small>
                    </div>

                    <div class="col-sm-6 mt-3 mt-sm-0">
                        <div class="vhs-btn text-center w-100 py-3">
                            <i class="bi bi-envelope-check"></i>
                            COMPROBANTE ENVIADO
                        </div>
                    </div>
                </section>

                <section class="mt-5 pt-4 border-top border-secondary">
                    <div class="row text-center text-secondary small">
                        <div class="col-4 border-end border-secondary">
                            PEDIDO<br>
                            <b class="text-light">#{{ $compra->compra_id }}</b>
                        </div>

                        <div class="col-4 border-end border-secondary">
                            ESTADO<br>
                            <b class="text-light">{{ strtoupper($compra->estado) }}</b>
                        </div>

                        <div class="col-4">
                            COMPROBANTE<br>
                            <b class="text-light">EMAIL</b>
                        </div>
                    </div>
                </section>
            </section>
        </div>
    </article>
</x-principal-layout>