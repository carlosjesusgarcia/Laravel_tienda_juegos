<x-principal-layout>
    <x-slot:title>Confirmación de Eliminación</x-slot:title>

    <section
        class="container py-5 text-light"
        aria-labelledby="titulo-eliminar-juego"
    >
        <h1
            id="titulo-eliminar-juego"
            class="mb-3 text-danger fw-bold"
        >
            Confirmación necesaria para eliminar
        </h1>

        <p class="mb-3">
            Estás por eliminar de manera definitiva el cartucho
            <strong class="text-vhs-yellow">
                {{ $juego->titulo }}
            </strong>.
        </p>

        <p class="mb-3">
            Esta acción
            <strong class="text-danger">
                no es reversible
            </strong>
            y requiere una confirmación.
        </p>

        <p class="mb-3">
            A continuación se muestran los datos del registro que será eliminado.
        </p>

        <hr class="mb-4 border-secondary">

        <section aria-labelledby="titulo-juego">
            <h2
                id="titulo-juego"
                class="mb-3"
                style="color: #ff3355;"
            >
                {{ $juego->titulo }}
            </h2>

            <dl class="mb-3">
                <dt class="text-vhs-cyan">
                    <strong>Precio</strong>
                </dt>

                <dd class="mb-3">
                    ${{ number_format($juego->precio / 100, 2) }}
                </dd>

                <dt class="text-vhs-cyan">
                    <strong>Fecha de lanzamiento</strong>
                </dt>

                <dd class="mb-3">
                    {{ \Carbon\Carbon::parse($juego->fecha_lanzamiento)->format('d/m/Y') }}
                </dd>
            </dl>
        </section>

        <hr class="mb-4 border-secondary">

        <section aria-labelledby="titulo-sinopsis">
            <h3
                id="titulo-sinopsis"
                class="mb-2 text-vhs-cyan"
            >
                Sinopsis
            </h3>

            <p
                class="mb-4"
                style="color: #ccc; line-height: 1.8;"
            >
                {{ $juego->sinopsis }}
            </p>
        </section>

        <hr class="mb-4 border-secondary">

        <form
            action="{{ route('juegos.eliminar', $juego) }}"
            method="POST"
            class="mt-4"
        >
            @csrf

            <div class="d-flex gap-3 align-items-center">
                <button
                    type="submit"
                    class="btn btn-danger fw-bold px-4 py-2"
                >
                    [ CONFIRMAR ELIMINACIÓN ]
                </button>

                <a
                    href="{{ route('juegos.listado') }}"
                    class="btn btn-outline-secondary px-4 py-2 fw-bold"
                >
                    CANCELAR
                </a>
            </div>
        </form>
    </section>
</x-principal-layout>