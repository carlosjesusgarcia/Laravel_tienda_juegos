<x-principal-layout>
    <x-slot:title>Confirmación de Eliminación</x-slot:title>

    <div class="container py-5 text-light">

        {{-- Encabezado de advertencia --}}
        <h1 class="mb-3 text-danger fw-bold">
            Confirmación necesaria para eliminar
        </h1>

        <p class="mb-3">
            Estás por eliminar de manera definitiva el cartucho <b class="text-vhs-yellow">{{ $juego->titulo }}</b>.
        </p>
        <p class="mb-3">
            Esta acción <b class="text-danger">no es reversible</b>, y requiere una confirmación.
        </p>
        <p class="mb-3">
            A continuación se muestran los datos del registro.
        </p>

        <hr class="mb-4 border-secondary">

        {{--
         |--------------------------------------------------------------------------
         | Resumen de Datos del Registro
         |--------------------------------------------------------------------------
         | Se utiliza una lista de definición (<dl>) para presentar los metadatos
         | clave de forma semántica y estructurada antes de la confirmación.
         --}}
        <h2 class="mb-3" style="color: #ff3355;">{{ $juego->titulo }}</h2>

        <dl class="mb-3">
            <dt class="text-vhs-cyan"><b>Precio</b></dt>
            <dd class="mb-3">${{ number_format($juego->precio / 100, 2) }}</dd>

            <dt class="text-vhs-cyan"><b>Fecha de lanzamiento</b></dt>
            <dd class="mb-3">{{ \Carbon\Carbon::parse($juego->fecha_lanzamiento)->format('d/m/Y') }}</dd>
        </dl>

        <hr class="mb-4 border-secondary">

        {{-- Sección de contenido extenso --}}
        <h3 class="mb-2 text-vhs-cyan">Sinopsis</h3>

        <div class="mb-4" style="color: #ccc; line-height: 1.8;">
            {{ $juego->sinopsis }}
        </div>

        <hr class="mb-4 border-secondary">

        {{--
         |--------------------------------------------------------------------------
         | Formulario de Ejecución
         |--------------------------------------------------------------------------
         | Contiene los controles finales. La acción de borrado requiere el método
         | POST y el token CSRF por normativas de seguridad del framework.
         --}}
        <form action="{{ route('juegos.eliminar', $juego) }}" method="POST" class="mt-4">
            @csrf
            <div class="d-flex gap-3 align-items-center">
                <button type="submit" class="btn btn-danger fw-bold px-4 py-2">
                    [ CONFIRMAR ELIMINACIÓN ]
                </button>
                <a href="{{ route('juegos.listado') }}" class="btn btn-outline-secondary px-4 py-2 fw-bold">
                    CANCELAR
                </a>
            </div>
        </form>

    </div>
</x-principal-layout>
