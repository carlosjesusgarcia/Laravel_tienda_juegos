<x-principal-layout>

    <x-slot:title>Mis Compras</x-slot:title>



    <article class="container py-5">

        <div class="mb-4">

            <a href="{{ route('perfil.index') }}" class="btn btn-vhs-yellow">

                <i class="bi bi-arrow-left"></i> [ VOLVER A MI PERFIL ]

            </a>

        </div>



        <h1

            class="display-3 fw-bold text-uppercase mb-2"

            style="color: #ff3355; text-shadow: 0 0 10px rgba(255, 51, 85, 0.6);"

        >

            Mis compras

        </h1>



        <p class="text-secondary fw-bold mb-5">

            Historial de pedidos registrados en Retro Games.

        </p>



        @if($compras->isNotEmpty())

            <section aria-labelledby="historial-compras">

                <h2 id="historial-compras" class="visually-hidden">

                    Historial de compras

                </h2>



                <div class="row g-4">

                    @foreach($compras as $compra)

                        <article class="col-12">

                            <div class="vhs-card p-4 shadow-lg">

                                <div class="row align-items-center g-4">

                                    <div class="col-md-2">

                                        <span class="text-secondary small text-uppercase">

                                            Pedido

                                        </span>



                                        <p class="h3 text-danger fw-bold mb-0">

                                            #{{ $compra->compra_id }}

                                        </p>

                                    </div>



                                    <div class="col-md-2">

                                        <span class="text-secondary small text-uppercase">

                                            Fecha

                                        </span>



                                        <p class="text-light fw-bold mb-0">

                                            {{ $compra->fecha_compra->format('d/m/Y') }}

                                        </p>

                                    </div>



                                    <div class="col-md-2">

                                        <span class="text-secondary small text-uppercase">

                                            Juegos

                                        </span>



                                        <p class="text-light fw-bold mb-0">

                                            {{ $compra->detalles->sum('cantidad') }}

                                        </p>

                                    </div>



                                    <div class="col-md-2">

                                        <span class="text-secondary small text-uppercase">

                                            Total

                                        </span>



                                        <p class="h4 text-warning fw-bold mb-0">

                                            ${{ number_format($compra->total, 0, ',', '.') }}

                                        </p>

                                    </div>



                                    <div class="col-md-2">

                                        <span class="text-secondary small text-uppercase">

                                            Estado

                                        </span>



                                        <p class="mb-0">

                                            <span class="badge bg-warning text-black fw-bold px-3 py-2">

                                                {{ strtoupper($compra->estado) }}

                                            </span>

                                        </p>

                                    </div>



                                    <div class="col-md-2 text-md-end">

                                        <a

                                            href="{{ route('compras.detalles', $compra->compra_id) }}"

                                            class="btn vhs-btn"

                                        >

                                            <i class="bi bi-file-earmark-text"></i>

                                            VER PEDIDO

                                        </a>

                                    </div>

                                </div>

                            </div>

                        </article>

                    @endforeach

                </div>

            </section>

        @else

            <section

                class="p-4"

                style="background-color: #1a1a1a; border-left: 4px solid #ff8800;"

            >

                <h2 class="h2 text-uppercase text-secondary fw-bold mb-3">

                    Sin compras registradas

                </h2>



                <p class="lead mb-4" style="color: #ccc;">

                    Todavía no realizaste ningún pedido en Retro Games.

                </p>



                <a href="{{ route('juegos.listado') }}" class="btn vhs-btn btn-lg">

                    <i class="bi bi-controller"></i> VER CATÁLOGO

                </a>

            </section>

        @endif

    </article>

</x-principal-layout> 

