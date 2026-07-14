<x-principal-layout>

    <x-slot:title>¿Quiénes somos?</x-slot:title>

    <section
        class="my-5"
        aria-labelledby="titulo-nosotros"
    >
        <div class="row align-items-center g-5">
            <div class="col-lg-7">
                <p class="text-info fw-bold mb-2">
                    NUESTRA HISTORIA
                </p>

                <h1
                    id="titulo-nosotros"
                    class="display-5 fw-bold mb-4"
                >
                    Sobre Retro Games
                </h1>

                <p class="lead text-light mb-4">
                    Retro Games nació para quienes siguen disfrutando de los
                    videojuegos clásicos tanto como el primer día.
                </p>

                <p class="text-secondary">
                    Crecimos entre cartuchos, salones arcade y consolas de 8 y
                    16 bits. Por eso armamos un catálogo pensado para quienes
                    disfrutan jugar, coleccionar o simplemente volver a encontrarse
                    con los títulos que marcaron una época.
                </p>

                <p class="text-secondary mb-0">
                    Creemos que un buen videojuego nunca deja de ser interesante.
                    Queremos que descubrir cada título sea una experiencia simple,
                    cercana y entretenida.
                </p>
            </div>

            <div class="col-lg-5">
                <aside
                    class="vhs-card h-100"
                    aria-labelledby="titulo-identidad"
                >
                    <div class="card-body">
                        <p class="text-warning fw-bold mb-2">
                            DESDE LA ERA DE LOS 8 BITS
                        </p>

                        <h2
                            id="titulo-identidad"
                            class="card-title h3"
                        >
                            Una tienda con identidad arcade
                        </h2>

                        <p class="card-text">
                            Los gráficos pixelados, la música chiptune y aquellos
                            controles sencillos siguen teniendo un encanto especial.
                        </p>

                        <p class="card-text mb-0">
                            Queremos que Retro Games sea un lugar donde esa etapa
                            del videojuego vuelva a encontrarse con viejos jugadores
                            y también con nuevas generaciones.
                        </p>
                    </div>
                </aside>
            </div>
        </div>
    </section>

    <section
        class="mb-5"
        aria-labelledby="titulo-mision"
    >
        <div class="text-center mb-4">
            <p class="text-info fw-bold mb-2">
                NUESTRO PROPÓSITO
            </p>

            <h2
                id="titulo-mision"
                class="text-warning fw-bold"
            >
                Mantener viva la cultura del videojuego clásico
            </h2>
        </div>

        <div class="row g-4">
            <div class="col-md-4">
                <article class="vhs-card h-100">
                    <div class="card-body">
                        <h3 class="card-title">
                            Memoria
                        </h3>

                        <p class="card-text mb-0">
                            Reunimos juegos que marcaron distintas épocas,
                            plataformas y formas de jugar.
                        </p>
                    </div>
                </article>
            </div>

            <div class="col-md-4">
                <article class="vhs-card h-100">
                    <div class="card-body">
                        <h3 class="card-title">
                            Colección
                        </h3>

                        <p class="card-text mb-0">
                            Cada ficha reúne información útil para conocer mejor
                            el juego antes de incorporarlo a una colección.
                        </p>
                    </div>
                </article>
            </div>

            <div class="col-md-4">
                <article class="vhs-card h-100">
                    <div class="card-body">
                        <h3 class="card-title">
                            Comunidad
                        </h3>

                        <p class="card-text mb-0">
                            Compartimos noticias, curiosidades y artículos para
                            seguir hablando de los videojuegos que hicieron historia.
                        </p>
                    </div>
                </article>
            </div>
        </div>
    </section>

    <section
        class="mb-5 p-4 p-lg-5 border border-secondary rounded"
        aria-labelledby="titulo-experiencia"
    >
        <div class="row align-items-center g-4">
            <div class="col-lg-8">
                <p class="text-info fw-bold mb-2">
                    LA EXPERIENCIA RETRO
                </p>

                <h2
                    id="titulo-experiencia"
                    class="text-warning fw-bold mb-4"
                >
                    Más que una tienda de videojuegos
                </h2>

                <p class="text-light">
                    Nos gusta esa sensación de volver a encontrar un juego que
                    creíamos olvidado, reconocer una portada o escuchar otra vez
                    la música de una pantalla de inicio.
                </p>

                <p class="text-secondary mb-0">
                    Además de ofrecer videojuegos, queremos compartir historias,
                    recomendaciones y curiosidades para que cada visita tenga algo
                    interesante.
                </p>
            </div>

            <div class="col-lg-4">
                <div class="text-center">
                    <p class="display-5 fw-bold text-light mb-2">
                        8-BIT
                    </p>

                    <p class="text-warning fw-bold mb-0">
                        MEMORIA · COLECCIÓN · CULTURA
                    </p>
                </div>
            </div>
        </div>
    </section>

    <section
        class="mb-5 text-center"
        aria-labelledby="titulo-catalogo"
    >
        <h2
            id="titulo-catalogo"
            class="text-warning fw-bold mb-3"
        >
            Descubrí nuestro catálogo
        </h2>

        <p class="text-secondary mb-4">
            Encontrá juegos que marcaron una época y quizá alguno que todavía
            te esté esperando.
        </p>

        <a
            href="{{ route('juegos.listado') }}"
            class="btn btn-vhs-yellow btn-lg fw-bold"
        >
            Explorar catálogo
        </a>
    </section>

</x-principal-layout>