<?php

/** @var \App\Models\Compra $compra */
/** @var \MercadoPago\Resources\Preference $preference */
/** @var string $mercadopagoPublicKey */

?>

<x-principal-layout>
    <x-slot:title>Pagar pedido #{{ $compra->compra_id }}</x-slot:title>

    <section
        class="container py-5"
        aria-labelledby="titulo-pago"
    >
        <h1
            id="titulo-pago"
            class="display-3 fw-bold text-uppercase mb-2"
            style="color: #ff3355; text-shadow: 0 0 10px rgba(255, 51, 85, 0.6);"
        >
            Pagar pedido
        </h1>

        <p class="text-secondary fw-bold mb-5">
            Revisá el pedido y completá el pago mediante Mercado Pago.
        </p>

        <section
            class="p-4 mb-5"
            aria-labelledby="titulo-datos-pedido"
            style="background-color: #1a1a1a; border-left: 4px solid #ff8800;"
        >
            <h2
                id="titulo-datos-pedido"
                class="text-uppercase text-secondary fw-bold mb-3"
            >
                Datos del pedido
            </h2>

            <dl class="row mb-0">
                <dt class="col-md-3 text-warning">
                    Número
                </dt>

                <dd class="col-md-9 text-light">
                    #{{ $compra->compra_id }}
                </dd>

                <dt class="col-md-3 text-warning">
                    Comprador
                </dt>

                <dd class="col-md-9 text-light">
                    {{ $compra->usuario->name }}
                </dd>

                <dt class="col-md-3 text-warning">
                    Estado
                </dt>

                <dd class="col-md-9 text-light mb-0">
                    {{ ucfirst($compra->estado) }}
                </dd>
            </dl>
        </section>

        <section aria-labelledby="titulo-resumen-pago">
            <h2
                id="titulo-resumen-pago"
                class="text-uppercase text-secondary fw-bold mb-4"
            >
                Resumen del pedido
            </h2>

            <div class="table-responsive">
                <table class="table table-dark table-bordered align-middle">
                    <thead>
                        <tr>
                            <th scope="col">
                                Juego
                            </th>

                            <th scope="col">
                                Precio
                            </th>

                            <th scope="col">
                                Cantidad
                            </th>

                            <th scope="col">
                                Subtotal
                            </th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($compra->detalles as $detalle)
                            <tr>
                                <td>
                                    {{ $detalle->descripcion }}
                                </td>

                                <td>
                                    ${{ number_format($detalle->precio_unitario, 0, ',', '.') }}
                                </td>

                                <td>
                                    {{ $detalle->cantidad }}
                                </td>

                                <td>
                                    ${{ number_format(
                                        $detalle->precio_unitario * $detalle->cantidad,
                                        0,
                                        ',',
                                        '.'
                                    ) }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>

                    <tfoot>
                        <tr>
                            <th
                                scope="row"
                                colspan="3"
                                class="text-end"
                            >
                                Total
                            </th>

                            <td class="fw-bold text-warning">
                                ${{ number_format($compra->total, 0, ',', '.') }}
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </section>

        <section
            class="p-4 mt-5"
            aria-labelledby="titulo-mercado-pago"
            style="background-color: #1a1a1a; border-left: 4px solid #00a6ff;"
        >
            <h2
                id="titulo-mercado-pago"
                class="h3 text-secondary fw-bold text-uppercase mb-3"
            >
                Mercado Pago
            </h2>

            <p class="text-light mb-4">
                Presioná el botón para continuar con el pago de prueba.
            </p>

            <div id="mercadopago-button"></div>
        </section>
    </section>

    <script src="https://sdk.mercadopago.com/js/v2"></script>

    <script>
        const publicKey = '{{ $mercadopagoPublicKey }}';
        const preferenceId = '{{ $preference->id }}';

        const mercadopago = new MercadoPago(publicKey);

        const builder = mercadopago.bricks();

        const renderPaymentButton = async (builder) => {
            await builder.create('wallet', 'mercadopago-button', {
                initialization: {
                    preferenceId,
                }
            });
        }

        renderPaymentButton(builder);
    </script>
</x-principal-layout>