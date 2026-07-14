<x-principal-layout>
    <x-slot:title>Confirmar Compra</x-slot:title>

    <section
        class="container py-5"
        aria-labelledby="titulo-confirmar-compra"
    >
        <div class="mb-4">
            <a
                href="{{ route('carrito.index') }}"
                class="btn btn-vhs-yellow"
            >
                <i class="bi bi-arrow-left" aria-hidden="true"></i>
                [ VOLVER AL CARRITO ]
            </a>
        </div>

        <h1
            id="titulo-confirmar-compra"
            class="display-3 fw-bold text-uppercase mb-2"
            style="color: #ff3355; text-shadow: 0 0 10px rgba(255, 51, 85, 0.6);"
        >
            Confirmar compra
        </h1>

        <p class="text-secondary fw-bold mb-5">
            Revisá los datos del pedido antes de registrarlo.
        </p>

        <section
            class="p-4 mb-5"
            aria-labelledby="titulo-datos-comprador"
            style="background-color: #1a1a1a; border-left: 4px solid #ff8800;"
        >
            <h2
                id="titulo-datos-comprador"
                class="text-uppercase text-secondary fw-bold mb-3"
            >
                Datos del comprador
            </h2>

            <dl class="row mb-0">
                <dt class="col-md-3 text-warning">
                    Nombre
                </dt>

                <dd class="col-md-9 text-light">
                    {{ auth()->user()->name }}
                </dd>

                <dt class="col-md-3 text-warning">
                    Correo electrónico
                </dt>

                <dd class="col-md-9 text-light mb-0">
                    {{ auth()->user()->email }}
                </dd>
            </dl>
        </section>

        <section aria-labelledby="titulo-resumen-pedido">
            <h2
                id="titulo-resumen-pedido"
                class="text-uppercase text-secondary fw-bold mb-4"
            >
                Resumen del pedido
            </h2>

            <div class="row g-4">
                @foreach($productosCarrito as $producto)
                    <article
                        class="col-12"
                        aria-labelledby="titulo-producto-{{ $producto['juego']->juego_id }}"
                    >
                        <div class="vhs-card p-4 shadow-lg">
                            <div class="row align-items-center g-4">
                                <div class="col-md-2">
                                    @if(
                                        $producto['juego']->portada !== null &&
                                        \Storage::exists($producto['juego']->portada)
                                    )
                                        <img
                                            src="{{ \Storage::url($producto['juego']->portada) }}"
                                            class="img-fluid w-100"
                                            alt="{{ $producto['juego']->portada_descripcion ?? 'Portada del juego ' . $producto['juego']->titulo }}"
                                            style="filter: grayscale(0.2) contrast(1.2);"
                                        >
                                    @endif
                                </div>

                                <div class="col-md-4">
                                    <h3
                                        id="titulo-producto-{{ $producto['juego']->juego_id }}"
                                        class="h3 text-danger fw-bold text-uppercase mb-2"
                                    >
                                        {{ $producto['juego']->titulo }}
                                    </h3>

                                    <a
                                        href="{{ route('juegos.detalles', $producto['juego']) }}"
                                        class="btn btn-vhs-yellow btn-sm"
                                    >
                                        [ VER EXPEDIENTE ]
                                    </a>
                                </div>

                                <div class="col-md-2">
                                    <span class="text-secondary small text-uppercase">
                                        Precio unitario
                                    </span>

                                    <p class="h4 text-white fw-bold mb-0">
                                        ${{ number_format($producto['juego']->precio, 0, ',', '.') }}
                                    </p>
                                </div>

                                <div class="col-md-2">
                                    <span class="text-secondary small text-uppercase">
                                        Cantidad
                                    </span>

                                    <p class="h4 text-white fw-bold mb-0">
                                        {{ $producto['cantidad'] }}
                                    </p>
                                </div>

                                <div class="col-md-2 text-md-end">
                                    <span class="text-secondary small text-uppercase">
                                        Subtotal
                                    </span>

                                    <p class="h4 text-warning fw-bold mb-0">
                                        ${{ number_format($producto['subtotal'], 0, ',', '.') }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>
        </section>

        <section
            class="p-4 mt-5"
            aria-labelledby="titulo-total-pedido"
            style="background-color: #1a1a1a; border-left: 4px solid #ff8800;"
        >
            <div class="row align-items-center g-4">
                <div class="col-md-6">
                    <h2
                        id="titulo-total-pedido"
                        class="h3 text-secondary fw-bold text-uppercase mb-2"
                    >
                        Total del pedido
                    </h2>

                    <p class="display-5 text-white fw-bold mb-0">
                        ${{ number_format($total, 0, ',', '.') }}
                    </p>
                </div>

                <div class="col-md-6">
                    <form
                        action="{{ route('compras.guardar') }}"
                        method="post"
                    >
                        @csrf

                        <button
                            type="submit"
                            class="btn vhs-btn btn-lg w-100 py-3"
                        >
                            <i
                                class="bi bi-check-circle"
                                aria-hidden="true"
                            ></i>
                            CONFIRMAR PEDIDO
                        </button>
                    </form>
                </div>
            </div>
        </section>

        <p class="text-secondary small mt-4 mb-0">
            Al confirmar, el pedido se registrará con estado pendiente y recibirás
            el comprobante en tu correo electrónico.
        </p>
    </section>
</x-principal-layout>