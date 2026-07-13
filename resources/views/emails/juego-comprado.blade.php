<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Confirmación de compra #{{ $compra->compra_id }}</title>
</head>

<body style="margin: 0; padding: 0; background-color: #111111; color: #eeeeee; font-family: Arial, Helvetica, sans-serif;">
    <table
        role="presentation"
        width="100%"
        cellspacing="0"
        cellpadding="0"
        style="background-color: #111111; padding: 30px 15px;"
    >
        <tr>
            <td align="center">
                <table
                    role="presentation"
                    width="100%"
                    cellspacing="0"
                    cellpadding="0"
                    style="max-width: 700px; background-color: #000000; border: 2px solid #ff3355;"
                >
                    <tr>
                        <td
                            style="padding: 24px; background-color: #1a1a1a; border-bottom: 2px solid #ff3355;"
                        >
                            <h1
                                style="margin: 0; color: #ff3355; font-size: 30px; text-transform: uppercase;"
                            >
                                Retro Games
                            </h1>

                            <p
                                style="margin: 8px 0 0; color: #ffcc00; font-size: 16px; font-weight: bold;"
                            >
                                Confirmación de compra #{{ $compra->compra_id }}
                            </p>
                        </td>
                    </tr>

                    <tr>
                        <td style="padding: 30px 24px;">
                            <p style="margin-top: 0; color: #eeeeee; font-size: 17px;">
                                Hola, <strong>{{ $compra->usuario->name }}</strong>.
                            </p>

                            <p style="color: #cccccc; line-height: 1.6;">
                                Tu pedido fue registrado correctamente en Retro Games.
                                Actualmente se encuentra en estado
                                <strong style="color: #ffcc00;">
                                    {{ strtoupper($compra->estado) }}
                                </strong>.
                            </p>

                            <table
                                role="presentation"
                                width="100%"
                                cellspacing="0"
                                cellpadding="10"
                                style="margin: 25px 0; border-collapse: collapse; background-color: #1a1a1a;"
                            >
                                <tr>
                                    <td style="color: #ffcc00; border-bottom: 1px solid #555555;">
                                        Número de pedido
                                    </td>

                                    <td
                                        align="right"
                                        style="color: #ffffff; border-bottom: 1px solid #555555;"
                                    >
                                        #{{ $compra->compra_id }}
                                    </td>
                                </tr>

                                <tr>
                                    <td style="color: #ffcc00; border-bottom: 1px solid #555555;">
                                        Fecha
                                    </td>

                                    <td
                                        align="right"
                                        style="color: #ffffff; border-bottom: 1px solid #555555;"
                                    >
                                        {{ $compra->fecha_compra->format('d/m/Y') }}
                                    </td>
                                </tr>

                                <tr>
                                    <td style="color: #ffcc00;">
                                        Estado
                                    </td>

                                    <td align="right" style="color: #ffffff;">
                                        {{ strtoupper($compra->estado) }}
                                    </td>
                                </tr>
                            </table>

                            <h2
                                style="margin: 30px 0 15px; color: #ff8800; font-size: 22px; text-transform: uppercase;"
                            >
                                Cartuchos incluidos
                            </h2>

                            <table
                                role="presentation"
                                width="100%"
                                cellspacing="0"
                                cellpadding="10"
                                style="border-collapse: collapse;"
                            >
                                <thead>
                                    <tr style="background-color: #222222;">
                                        <th
                                            align="left"
                                            style="color: #ffcc00; border: 1px solid #555555;"
                                        >
                                            Juego
                                        </th>

                                        <th
                                            align="center"
                                            style="color: #ffcc00; border: 1px solid #555555;"
                                        >
                                            Cantidad
                                        </th>

                                        <th
                                            align="right"
                                            style="color: #ffcc00; border: 1px solid #555555;"
                                        >
                                            Precio
                                        </th>

                                        <th
                                            align="right"
                                            style="color: #ffcc00; border: 1px solid #555555;"
                                        >
                                            Subtotal
                                        </th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach($compra->detalles as $detalle)
                                        <tr>
                                            <td
                                                style="color: #eeeeee; border: 1px solid #555555;"
                                            >
                                                {{ $detalle->descripcion }}
                                            </td>

                                            <td
                                                align="center"
                                                style="color: #eeeeee; border: 1px solid #555555;"
                                            >
                                                {{ $detalle->cantidad }}
                                            </td>

                                            <td
                                                align="right"
                                                style="color: #eeeeee; border: 1px solid #555555;"
                                            >
                                                ${{ number_format($detalle->precio_unitario, 0, ',', '.') }}
                                            </td>

                                            <td
                                                align="right"
                                                style="color: #eeeeee; border: 1px solid #555555;"
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
                            </table>

                            <table
                                role="presentation"
                                width="100%"
                                cellspacing="0"
                                cellpadding="15"
                                style="margin-top: 25px; background-color: #1a1a1a; border-left: 4px solid #ff8800;"
                            >
                                <tr>
                                    <td style="color: #cccccc; font-size: 18px;">
                                        Total del pedido
                                    </td>

                                    <td
                                        align="right"
                                        style="color: #ffffff; font-size: 24px; font-weight: bold;"
                                    >
                                        ${{ number_format($compra->total, 0, ',', '.') }}
                                    </td>
                                </tr>
                            </table>

                            <p style="margin: 30px 0 0; color: #cccccc; line-height: 1.6;">
                                El comprobante completo del pedido se encuentra adjunto
                                a este correo electrónico.
                            </p>

                            <p style="margin-bottom: 0; color: #888888; font-size: 14px;">
                                Este mensaje fue generado automáticamente por Retro Games.
                            </p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>