<x-principal-layout>
    <x-slot:title>Expediente: {{ $juego->titulo }}</x-slot:title>

    <section
        class="container py-5"
        aria-labelledby="titulo-juego"
    >
        <div class="mb-4">
            <a
                href="{{ route('juegos.listado') }}"
                class="btn btn-vhs-yellow"
            >
                <i class="bi bi-arrow-left" aria-hidden="true"></i>
                [ VOLVER AL ARCHIVO ]
            </a>
        </div>

        <div class="row g-5">
            <div class="col-md-5">
                <div class="vhs-card p-3 shadow-lg">
                    @if($juego->portada !== null && \Storage::exists($juego->portada))
                        <img
                            src="{{ \Storage::url($juego->portada) }}"
                            class="img-fluid w-100"
                            alt="{{ $juego->portada_descripcion ?? 'Portada del juego ' . $juego->titulo }}"
                            style="filter: grayscale(0.2) contrast(1.2);"
                        >
                    @endif

                    <div class="mt-3 text-center">
                        <span class="badge bg-danger text-black fw-bold px-3 py-2">
                            ESTADO: DISPONIBLE
                        </span>
                    </div>
                </div>
            </div>

            <div class="col-md-7">
                <h1
                    id="titulo-juego"
                    class="display-3 fw-bold text-uppercase mb-2"
                    style="color: #ff3355; text-shadow: 0 0 10px rgba(255, 51, 85, 0.6);"
                >
                    {{ $juego->titulo }}
                </h1>

                <div class="d-flex align-items-center gap-3 mb-4">
                    <span class="text-secondary fw-bold">
                        LANZAMIENTO: {{ $juego->fecha_lanzamiento }}
                    </span>

                    <span class="badge bg-warning text-black fw-bold">
                        CLASIFICACIÓN: {{ $juego->rating->abreviatura }}
                    </span>
                </div>

                <section
                    class="p-4 mb-4"
                    aria-labelledby="titulo-sinopsis"
                    style="background-color: #1a1a1a; border-left: 4px solid #ff8800;"
                >
                    <h2
                        id="titulo-sinopsis"
                        class="text-uppercase text-secondary fw-bold mb-3"
                        style="letter-spacing: 2px;"
                    >
                        Sinopsis
                    </h2>

                    <p
                        class="lead mb-0"
                        style="line-height: 1.8; color: #ccc;"
                    >
                        {{ $juego->sinopsis ?? 'No hay datos adicionales sobre este cartucho en la base de datos central.' }}
                    </p>
                </section>

                <div class="row align-items-center mt-5">
                    <div class="col-sm-6">
                        <p class="h1 fw-bold text-white mb-0">
                            ${{ number_format($juego->precio) }}
                        </p>

                        <small class="text-secondary text-uppercase">
                            Precio por cartucho original
                        </small>
                    </div>

                    <div class="col-sm-6 mt-3 mt-sm-0">
                        @auth
                            <form
                                action="{{ route('carrito.agregar', $juego->slug) }}"
                                method="post"
                            >
                                @csrf

                                <button
                                    type="submit"
                                    class="btn vhs-btn btn-lg w-100 py-3"
                                >
                                    <i
                                        class="bi bi-cart-plus"
                                        aria-hidden="true"
                                    ></i>
                                    COMPRALO AHORA
                                </button>
                            </form>
                        @else
                            <a
                                href="{{ route('login') }}"
                                class="btn vhs-btn btn-lg w-100 py-3"
                            >
                                <i
                                    class="bi bi-cart-plus"
                                    aria-hidden="true"
                                ></i>
                                COMPRALO AHORA
                            </a>
                        @endauth
                    </div>
                </div>

                <div class="mt-5 pt-4 border-top border-secondary">
                    <div class="row text-center text-secondary small">
                        <div class="col-4 border-end border-secondary">
                            FORMATO<br>
                            <strong class="text-light">NTSC</strong>
                        </div>

                        <div class="col-4 border-end border-secondary">
                            GÉNERO<br>

                            @foreach($juego->generos as $genero)
                                <strong class="text-light">
                                    {{ $genero->nombre }}
                                </strong>
                                <br>
                            @endforeach
                        </div>

                        <div class="col-4">
                            COPIAS<br>
                            <strong class="text-light">LIMITADAS</strong>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-principal-layout>