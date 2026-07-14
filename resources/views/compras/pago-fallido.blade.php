<x-principal-layout>
    <x-slot:title>Pago fallido</x-slot:title>

    <section
        class="container py-5"
        aria-labelledby="titulo-pago-fallido"
    >
        <h1
            id="titulo-pago-fallido"
            class="display-3 fw-bold text-uppercase mb-2"
            style="color: #ff3355; text-shadow: 0 0 10px rgba(255, 51, 85, 0.6);"
        >
            Pago no completado
        </h1>

        <p class="text-secondary fw-bold mb-5">
            Mercado Pago rechazó o canceló el pago del pedido.
        </p>

        <section
            class="p-4 mb-4"
            aria-labelledby="titulo-pedido-fallido"
            style="background-color: #1a1a1a; border-left: 4px solid #ff3355;"
        >
            <h2
                id="titulo-pedido-fallido"
                class="text-uppercase text-secondary fw-bold mb-3"
            >
                Pedido #{{ $compra->compra_id }}
            </h2>

            <dl class="row mb-0">
                <dt class="col-md-3 text-danger">
                    Estado
                </dt>

                <dd class="col-md-9 text-light">
                    Fallida
                </dd>

                <dt class="col-md-3 text-danger">
                    Total
                </dt>

                <dd class="col-md-9 text-light fw-bold mb-0">
                    ${{ number_format($compra->total, 0, ',', '.') }}
                </dd>
            </dl>
        </section>

        <p class="text-light mb-4">
            No se envió ningún comprobante porque el pago no fue aprobado.
            Podés volver a intentar el pago del mismo pedido.
        </p>

        <div class="d-flex flex-wrap gap-3">
            <a
                href="{{ route('compras.pago', $compra->compra_id) }}"
                class="btn vhs-btn"
            >
                <i class="bi bi-credit-card" aria-hidden="true"></i>
                REINTENTAR PAGO
            </a>

            <a
                href="{{ route('compras.index') }}"
                class="btn btn-vhs-yellow"
            >
                <i class="bi bi-clock-history" aria-hidden="true"></i>
                VER HISTORIAL
            </a>
        </div>
    </section>
</x-principal-layout>