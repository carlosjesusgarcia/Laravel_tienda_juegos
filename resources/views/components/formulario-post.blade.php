@props(['post' => null])

<form
    action="{{ $post ? route('posts.actualizar', $post) : route('posts.guardar') }}"
    method="POST"
    class="text-light"
    enctype="multipart/form-data"
>
    @csrf

    @if($post)
        @method('PUT')
    @endif

    <div class="mb-3">
        <label for="titulo" class="form-label text-vhs-yellow fw-bold">
            TÍTULO DE LA ENTRADA
        </label>

        <input
            type="text"
            class="form-control bg-dark text-light border-secondary @error('titulo') is-invalid @enderror"
            id="titulo"
            name="titulo"
            value="{{ old('titulo', $post?->titulo) }}"
            placeholder="Ej: El declive de los arcades"
        >

        @error('titulo')
            <div class="text-danger fw-bold mt-1">
                {{ $message }}
            </div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="subtitulo" class="form-label text-vhs-yellow fw-bold">
            SUBTÍTULO (OPCIONAL)
        </label>

        <input
            type="text"
            class="form-control bg-dark text-light border-secondary @error('subtitulo') is-invalid @enderror"
            id="subtitulo"
            name="subtitulo"
            value="{{ old('subtitulo', $post?->subtitulo) }}"
            placeholder="Ej: Crónica de una muerte anunciada"
        >

        @error('subtitulo')
            <div class="text-danger fw-bold mt-1">
                {{ $message }}
            </div>
        @enderror
    </div>

    {{-- PREVISUALIZACIÓN DE IMAGEN ACTUAL --}}
    @if($post && $post->imagen !== null && \Storage::exists($post->imagen))
        <div class="mb-3">
            <p class="form-label text-vhs-yellow fw-bold">
                IMAGEN ACTUAL
            </p>

            <img
                src="{{ \Storage::url($post->imagen) }}"
                alt="{{ $post->imagen_descripcion }}"
                class="img-thumbnail bg-dark border-secondary"
                style="max-width: 200px; height: auto;"
            >
        </div>
    @endif

    <div class="row">
        <div class="col-md-6 mb-3">
            <label for="imagen" class="form-label text-vhs-yellow fw-bold">
                {{ $post ? 'CAMBIAR IMAGEN' : 'IMAGEN PRINCIPAL' }}
            </label>

            <input
                type="file"
                class="form-control bg-dark text-light border-secondary @error('imagen') is-invalid @enderror"
                id="imagen"
                name="imagen"
                accept="image/jpeg,image/png,image/webp"
            >

            @error('imagen')
                <div class="text-danger fw-bold mt-1">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="col-md-6 mb-3">
            <label for="imagen_descripcion" class="form-label text-vhs-yellow fw-bold">
                DESCRIPCIÓN (ALT)
            </label>

            <input
                type="text"
                class="form-control bg-dark text-light border-secondary @error('imagen_descripcion') is-invalid @enderror"
                id="imagen_descripcion"
                name="imagen_descripcion"
                value="{{ old('imagen_descripcion', $post?->imagen_descripcion) }}"
                placeholder="Ej: Salón recreativo con neones"
            >

            @error('imagen_descripcion')
                <div class="text-danger fw-bold mt-1">
                    {{ $message }}
                </div>
            @enderror
        </div>
    </div>

    <div class="mb-4">
        <label for="contenido" class="form-label text-vhs-yellow fw-bold">
            CONTENIDO
        </label>

        <textarea
            class="form-control bg-dark text-light border-secondary @error('contenido') is-invalid @enderror"
            id="contenido"
            name="contenido"
            rows="10"
            placeholder="Redacta el contenido desclasificado aquí..."
        >{{ old('contenido', $post?->contenido) }}</textarea>

        @error('contenido')
            <div class="text-danger fw-bold mt-1">
                {{ $message }}
            </div>
        @enderror
    </div>

    <div class="d-grid gap-2">
        <button type="submit" class="btn btn-vhs-yellow fw-bold">
            [ {{ $post ? 'ACTUALIZAR REGISTRO' : 'PUBLICAR ENTRADA' }} ]
        </button>
    </div>
</form>