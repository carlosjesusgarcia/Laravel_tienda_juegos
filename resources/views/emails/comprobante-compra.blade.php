<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Comprobante de compra #{{ $compra->compra_id }}</title>
</head>

<body>
    <main>
        <h1>Comprobante de compra</h1>

        <p>
            Pedido número: {{ $compra->compra_id }}
        </p>

        <p>
            Fecha: {{ $compra->fecha_compra->format('d/m/Y') }}
        </p>

        <section>
            <h2>Datos del comprador</h2>

            <p>
                <strong>Nombre:</strong>
                {{ $compra->usuario->name }}
            </p>

            <p>
                <strong>Correo electrónico:</strong>
                {{ $compra->usuario->email }}
            </p>

            <p>
                <strong>Estado:</strong>
                {{ strtoupper($compra->estado) }}
            </p>
        </section>

        <section>
            <h2>Detalle del pedido</h2>

            <table border="1" cellpadding="8" cellspacing="0">
                <caption>
                    Juegos incluidos en la compra
                </caption>

                <thead>
                    <tr>
                        <th scope="col">Juego</th>
                        <th scope="col">Cantidad</th>
                        <th scope="col">Precio unitario</th>
                        <th scope="col">Subtotal</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($compra->detalles as $detalle)
                        <tr>
                            <td>{{ $detalle->descripcion }}</td>

                            <td>{{ $detalle->cantidad }}</td>

                            <td>
                                ${{ number_format($detalle->precio_unitario, 0, ',', '.') }}
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
                        <th scope="row" colspan="3">
                            Total
                        </th>

                        <td>
                            <strong>
                                ${{ number_format($compra->total, 0, ',', '.') }}
                            </strong>
                        </td>
                    </tr>
                </tfoot>
            </table>
        </section>

        <p>
            Este comprobante corresponde al pedido
            #{{ $compra->compra_id }} registrado en Retro Games.
        </p>

        <p>
            Este documento no constituye una factura fiscal.
        </p>
    </main>
</body>
</html>