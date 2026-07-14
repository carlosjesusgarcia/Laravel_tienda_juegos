<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Confirmación de compra #{{ $compra->compra_id }}</title>
</head>

<body>
    <main>
        <h1>Compra confirmada</h1>

        <p>
            Hola, <strong>{{ $compra->usuario->name }}</strong>.
        </p>

        <p>
            Tu pedido fue registrado correctamente en Retro Games.
        </p>

        <p>
            <strong>Número de pedido:</strong>
            {{ $compra->compra_id }}
        </p>

        <p>
            <strong>Fecha:</strong>
            {{ $compra->fecha_compra->format('d/m/Y') }}
        </p>

        <p>
            <strong>Estado:</strong>
            {{ strtoupper($compra->estado) }}
        </p>

        <section>
            <h2>Juegos comprados</h2>

            <ul>
                @foreach($compra->detalles as $detalle)
                    <li>
                        {{ $detalle->descripcion }}
                        — Cantidad: {{ $detalle->cantidad }}
                        — ${{ number_format($detalle->precio_unitario, 0, ',', '.') }}
                    </li>
                @endforeach
            </ul>
        </section>

        <p>
            <strong>Total:</strong>
            ${{ number_format($compra->total, 0, ',', '.') }}
        </p>

        <p>
            El comprobante completo se encuentra adjunto a este correo.
        </p>

        <p>
            Este mensaje fue generado automáticamente por Retro Games.
        </p>
    </main>
</body>
</html>