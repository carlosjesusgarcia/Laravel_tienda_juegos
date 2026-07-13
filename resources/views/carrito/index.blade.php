<x-principal-layout>
    <x-slot:title>Carrito de Compras</x-slot:title>

    <article class="container py-5">
        <div class="mb-4">
            <a href="{{ route('juegos.listado') }}" class="btn btn-vhs-yellow">
                <i class="bi bi-arrow-left"></i> [ VOLVER AL ARCHIVO ]
            </a>
        </div>

        <h1
            class="display-3 fw-bold text-uppercase mb-2"
            style="color: #ff3355; text-shadow: 0 0 10px rgba(255, 51, 85, 0.6);"
        >
            Carrito de compras
        </h1>

        <p class="text-secondary fw-bold mb-5">
            Revisá los cartuchos seleccionados antes de confirmar el pedido.
        </p>

        @error('cantidad')
            <div class="alert alert-danger mb-4">
                {{ $message }}
            </div>
        @enderror

        @if(count($productosCarrito) > 0)
            <section aria-labelledby="productos-carrito">
                <h2 id="productos-carrito" class="visually-hidden">
                    Juegos agregados al carrito
                </h2>

                <div class="row g-4">
                    @foreach($productosCarrito as $producto)
                        <article class="col-12">
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
                                        <h3 class="h3 text-danger fw-bold text-uppercase mb-2">
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
                                        <form
                                            action="{{ route('carrito.actualizar', $producto['juego']) }}"
                                            method="post"
                                        >
                                            @csrf
                                            @method('PUT')

                                            <label
                                                for="cantidad-{{ $producto['juego']->juego_id }}"
                                                class="form-label text-secondary small text-uppercase"
                                            >
                                                Cantidad
                                            </label>

                                            <div class="d-flex gap-2">
                                                <input
                                                    type="number"
                                                    id="cantidad-{{ $producto['juego']->juego_id }}"
                                                    name="cantidad"
                                                    value="{{ $producto['cantidad'] }}"
                                                    class="form-control bg-dark text-light border-secondary"
                                                >

                                                <button
                                                    type="submit"
                                                    class="btn btn-vhs-yellow"
                                                    aria-label="Actualizar cantidad de {{ $producto['juego']->titulo }}"
                                                >
                                                    <i class="bi bi-arrow-clockwise"></i>
                                                </button>
                                            </div>
                                        </form>
                                    </div>

                                    <div class="col-md-2 text-md-end">
                                        <span class="text-secondary small text-uppercase">
                                            Subtotal
                                        </span>

                                        <p class="h4 text-warning fw-bold">
                                            ${{ number_format($producto['subtotal'], 0, ',', '.') }}
                                        </p>

                                        <form
                                            action="{{ route('carrito.eliminar', $producto['juego']) }}"
                                            method="post"
                                        >
                                            @csrf
                                            @method('DELETE')

                                            <button
                                                type="submit"
                                                class="btn btn-outline-danger btn-sm"
                                            >
                                                <i class="bi bi-trash"></i> ELIMINAR
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>
            </section>

            <section
                class="p-4 mt-5"
                style="background-color: #1a1a1a; border-left: 4px solid #ff8800;"
            >
                <div class="row align-items-center g-4">
                    <div class="col-md-6">
                        <h2 class="h3 text-secondary fw-bold text-uppercase mb-2">
                            Total del pedido
                        </h2>

                        <p class="display-5 text-white fw-bold mb-0">
                            ${{ number_format($total, 0, ',', '.') }}
                        </p>
                    </div>

                    <div class="col-md-6">
                        <a
                            href="{{ route('compras.confirmar') }}"
                            class="btn vhs-btn btn-lg w-100 py-3"
                        >
                            <i class="bi bi-cart-check"></i> CONFIRMAR COMPRA
                        </a>
                    </div>
                </div>
            </section>

            <div class="mt-4">
                <form action="{{ route('carrito.vaciar') }}" method="post">
                    @csrf
                    @method('DELETE')

                    <button type="submit" class="btn btn-outline-danger">
                        <i class="bi bi-trash"></i> [ VACIAR CARRITO ]
                    </button>
                </form>
            </div>
        @else
            <section
                class="p-4"
                style="background-color: #1a1a1a; border-left: 4px solid #ff8800;"
            >
                <h2 class="h2 text-uppercase text-secondary fw-bold mb-3">
                    Carrito vacío
                </h2>

                <p class="lead mb-4" style="color: #ccc;">
                    Todavía no agregaste ningún cartucho al carrito de compras.
                </p>

                <a href="{{ route('juegos.listado') }}" class="btn vhs-btn btn-lg">
                    <i class="bi bi-controller"></i> VER CATÁLOGO
                </a>
            </section>
        @endif
    </article>
</x-principal-layout>