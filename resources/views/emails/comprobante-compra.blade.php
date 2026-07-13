<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">

    <title>Comprobante de compra #{{ $compra->compra_id }}</title>
</head>

<body style="margin: 0; padding: 30px; background-color: #ffffff; color: #222222; font-family: Arial, Helvetica, sans-serif;">
    <main
        style="max-width: 800px; margin: 0 auto; padding: 30px; border: 2px solid #222222;"
    >
        <header
            style="padding-bottom: 20px; margin-bottom: 25px; border-bottom: 3px solid #ff3355;"
        >
            <table
                role="presentation"
                width="100%"
                cellspacing="0"
                cellpadding="0"
            >
                <tr>
                    <td>
                        <h1
                            style="margin: 0; color: #ff3355; font-size: 32px; text-transform: uppercase;"
                        >
                            Retro Games
                        </h1>

                        <p
                            style="margin: 8px 0 0; color: #555555; font-size: 15px;"
                        >
                            Comprobante de compra
                        </p>
                    </td>

                    <td align="right">
                        <p
                            style="margin: 0; color: #222222; font-size: 22px; font-weight: bold;"
                        >
                            Pedido #{{ $compra->compra_id }}
                        </p>

                        <p style="margin: 8px 0 0; color: #555555;">
                            {{ $compra->fecha_compra->format('d/m/Y') }}
                        </p>
                    </td>
                </tr>
            </table>
        </header>

        <section style="margin-bottom: 30px;">
            <h2
                style="margin: 0 0 15px; color: #ff8800; font-size: 20px; text-transform: uppercase;"
            >
                Datos del comprador
            </h2>

            <table
                role="presentation"
                width="100%"
                cellspacing="0"
                cellpadding="8"
                style="border-collapse: collapse; background-color: #f2f2f2;"
            >
                <tr>
                    <th
                        align="left"
                        style="width: 30%; border: 1px solid #cccccc;"
                    >
                        Nombre
                    </th>

                    <td style="border: 1px solid #cccccc;">
                        {{ $compra->usuario->name }}
                    </td>
                </tr>

                <tr>
                    <th
                        align="left"
                        style="border: 1px solid #cccccc;"
                    >
                        Correo electrónico
                    </th>

                    <td style="border: 1px solid #cccccc;">
                        {{ $compra->usuario->email }}
                    </td>
                </tr>

                <tr>
                    <th
                        align="left"
                        style="border: 1px solid #cccccc;"
                    >
                        Estado
                    </th>

                    <td style="border: 1px solid #cccccc;">
                        {{ strtoupper($compra->estado) }}
                    </td>
                </tr>
            </table>
        </section>

        <section style="margin-bottom: 30px;">
            <h2
                style="margin: 0 0 15px; color: #ff8800; font-size: 20px; text-transform: uppercase;"
            >
                Detalle del pedido
            </h2>

            <table
                width="100%"
                cellspacing="0"
                cellpadding="10"
                style="border-collapse: collapse;"
            >
                <thead>
                    <tr style="background-color: #222222;">
                        <th
                            align="left"
                            style="color: #ffffff; border: 1px solid #222222;"
                        >
                            Juego
                        </th>

                        <th
                            align="center"
                            style="color: #ffffff; border: 1px solid #222222;"
                        >
                            Cantidad
                        </th>

                        <th
                            align="right"
                            style="color: #ffffff; border: 1px solid #222222;"
                        >
                            Precio unitario
                        </th>

                        <th
                            align="right"
                            style="color: #ffffff; border: 1px solid #222222;"
                        >
                            Subtotal
                        </th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($compra->detalles as $detalle)
                        <tr>
                            <td style="border: 1px solid #cccccc;">
                                {{ $detalle->descripcion }}
                            </td>

                            <td
                                align="center"
                                style="border: 1px solid #cccccc;"
                            >
                                {{ $detalle->cantidad }}
                            </td>

                            <td
                                align="right"
                                style="border: 1px solid #cccccc;"
                            >
                                ${{ number_format(
                                    $detalle->precio_unitario,
                                    0,
                                    ',',
                                    '.'
                                ) }}
                            </td>

                            <td
                                align="right"
                                style="border: 1px solid #cccccc;"
                            >
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
                            colspan="3"
                            align="right"
                            style="padding: 15px; border: 1px solid #222222; background-color: #f2f2f2; font-size: 18px;"
                        >
                            TOTAL
                        </th>

                        <td
                            align="right"
                            style="padding: 15px; border: 1px solid #222222; background-color: #f2f2f2; font-size: 22px; font-weight: bold;"
                        >
                            ${{ number_format($compra->total, 0, ',', '.') }}
                        </td>
                    </tr>
                </tfoot>
            </table>
        </section>

        <footer
            style="padding-top: 20px; border-top: 1px solid #cccccc; color: #666666; font-size: 13px;"
        >
            <p style="margin: 0 0 8px;">
                Este comprobante corresponde al pedido
                #{{ $compra->compra_id }} registrado en Retro Games.
            </p>

            <p style="margin: 0;">
                El pedido se encuentra en estado
                <strong>{{ strtoupper($compra->estado) }}</strong>.
                Este documento no constituye una factura fiscal.
            </p>
        </footer>
    </main>
</body>
</html>