<x-principal-layout>
    <x-slot:title>Confirmación de Eliminación</x-slot:title>

    <div class="container py-5 text-light">

        {{-- Encabezado de advertencia --}}
        <h1 class="mb-3 text-danger fw-bold">
            Confirmación necesaria para eliminar
        </h1>

        <p class="mb-3">
            Estás por eliminar de manera definitiva la entrada
            <strong class="text-vhs-yellow">{{ $post->titulo }}</strong>.
        </p>

        <p class="mb-3">
            Esta acción <strong class="text-danger">no es reversible</strong>
            y requiere una confirmación.
        </p>

        <p class="mb-3">
            A continuación se muestran los datos del registro desclasificado.
        </p>

        <hr class="mb-4 border-secondary">

        <section aria-labelledby="titulo-post-eliminar">
            <h2
                id="titulo-post-eliminar"
                class="mb-3"
                style="color: #ff3355;"
            >
                {{ $post->titulo }}
            </h2>

            <dl class="mb-3">
                @if($post->subtitulo)
                    <dt class="text-vhs-cyan">Subtítulo</dt>
                    <dd class="mb-3">{{ $post->subtitulo }}</dd>
                @endif

                <dt class="text-vhs-cyan">Fecha de publicación</dt>
                <dd class="mb-3">
                    {{ $post->created_at->format('d/m/Y') }}
                </dd>
            </dl>

            <hr class="mb-4 border-secondary">

            {{-- Sección de contenido extenso --}}
            <section aria-labelledby="titulo-contenido-post">
                <h3
                    id="titulo-contenido-post"
                    class="mb-2 text-vhs-cyan"
                >
                    Contenido
                </h3>

                <div
                    class="mb-4"
                    style="color: #ccc; line-height: 1.8;"
                >
                    {!! nl2br(e($post->contenido)) !!}
                </div>
            </section>
        </section>

        <hr class="mb-4 border-secondary">

        <div class="d-flex flex-wrap gap-3 align-items-center mt-4">
            <a
                href="{{ route('posts.listado') }}"
                class="btn btn-outline-secondary px-4 py-2 fw-bold"
            >
                CANCELAR
            </a>

            <form
                action="{{ route('posts.eliminar', $post) }}"
                method="POST"
                class="m-0"
            >
                @csrf

                <button
                    type="submit"
                    class="btn btn-danger fw-bold px-4 py-2"
                >
                    [ CONFIRMAR ELIMINACIÓN ]
                </button>
            </form>
        </div>

    </div>
</x-principal-layout>