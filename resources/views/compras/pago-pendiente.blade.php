<x-principal-layout>
    <x-slot:title>Pago pendiente</x-slot:title>

    <section
        class="container py-5"
        aria-labelledby="titulo-pago-pendiente"
    >
        <h1
            id="titulo-pago-pendiente"
            class="display-3 fw-bold text-uppercase mb-2"
            style="color: #ff8800; text-shadow: 0 0 10px rgba(255, 136, 0, 0.6);"
        >
            Pago pendiente
        </h1>

        <p class="text-secondary fw-bold mb-5">
            Mercado Pago todavía no confirmó el pago del pedido.
        </p>

        <section
            class="p-4 mb-4"
            aria-labelledby="titulo-pedido-pendiente"
            style="background-color: #1a1a1a; border-left: 4px solid #ff8800;"
        >
            <h2
                id="titulo-pedido-pendiente"
                class="text-uppercase text-secondary fw-bold mb-3"
            >
                Pedido #{{ $compra->compra_id }}
            </h2>

            <dl class="row mb-0">
                <dt class="col-md-3 text-warning">
                    Estado
                </dt>

                <dd class="col-md-9 text-light">
                    Pendiente
                </dd>

                <dt class="col-md-3 text-warning">
                    Fecha
                </dt>

                <dd class="col-md-9 text-light">
                    {{ $compra->fecha_compra->format('d/m/Y') }}
                </dd>

                <dt class="col-md-3 text-warning">
                    Total
                </dt>

                <dd class="col-md-9 text-light fw-bold mb-0">
                    ${{ number_format($compra->total, 0, ',', '.') }}
                </dd>
            </dl>
        </section>

        <p class="text-light mb-4">
            El pedido permanecerá registrado con estado pendiente hasta que el
            pago sea aprobado o rechazado.
        </p>

        <a
            href="{{ route('compras.index') }}"
            class="btn vhs-btn"
        >
            <i class="bi bi-clock-history" aria-hidden="true"></i>
            VER HISTORIAL DE COMPRAS
        </a>
    </section>
</x-principal-layout>