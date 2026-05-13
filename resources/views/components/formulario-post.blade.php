@props(['post' => null])

<form action="{{ $post ? route('posts.actualizar', $post) : route('posts.guardar') }}" method="POST" class="text-light" enctype="multipart/form-data">
    @csrf

    {{-- Condicional para el método HTTP correcto en caso de actualización --}}
    @if($post)
        @method('PUT')
    @endif

    <div class="mb-3">
        <label for="titulo" class="form-label text-vhs-yellow fw-bold">TÍTULO DE LA ENTRADA</label>
        <input type="text"
               class="form-control bg-dark text-light border-secondary @error('titulo') is-invalid @enderror"
               id="titulo"
               name="titulo"
               @error('titulo')
                   aria-invalid="true"
                   aria-errormessage="error_titulo"
               @enderror
               value="{{ old('titulo', $post?->titulo) }}"
               placeholder="Ej: El declive de los arcades">

        @error('titulo')
            <div class="text-danger fw-bold mt-1" id="error_titulo">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="subtitulo" class="form-label text-vhs-yellow fw-bold">SUBTÍTULO (OPCIONAL)</label>
        <input type="text"
               class="form-control bg-dark text-light border-secondary @error('subtitulo') is-invalid @enderror"
               id="subtitulo"
               name="subtitulo"
               @error('subtitulo')
                   aria-invalid="true"
                   aria-errormessage="error_subtitulo"
               @enderror
               value="{{ old('subtitulo', $post?->subtitulo) }}"
               placeholder="Ej: Crónica de una muerte anunciada">

        @error('subtitulo')
            <div class="text-danger fw-bold mt-1" id="error_subtitulo">{{ $message }}</div>
        @enderror
    </div>

    <div class="row">
        <div class="col-md-6 mb-3">
            <label for="imagen" class="form-label text-vhs-yellow fw-bold">IMAGEN PRINCIPAL</label>
            <input type="file"
                   class="form-control bg-dark text-light border-secondary @error('imagen') is-invalid @enderror"
                   id="imagen"
                   name="imagen"
                   @error('imagen')
                       aria-invalid="true"
                       aria-errormessage="error_imagen"
                   @enderror>

            @error('imagen')
                <div class="text-danger fw-bold mt-1" id="error_imagen">{{ $message }}</div>
            @enderror
        </div>

        <div class="col-md-6 mb-3">
            <label for="imagen_descripcion" class="form-label text-vhs-yellow fw-bold">DESCRIPCIÓN DE IMAGEN (ACCESIBILIDAD)</label>
            <input type="text"
                   class="form-control bg-dark text-light border-secondary @error('imagen_descripcion') is-invalid @enderror"
                   id="imagen_descripcion"
                   name="imagen_descripcion"
                   @error('imagen_descripcion')
                       aria-invalid="true"
                       aria-errormessage="error_imagen_descripcion"
                   @enderror
                   value="{{ old('imagen_descripcion', $post?->imagen_descripcion) }}"
                   placeholder="Ej: Salón recreativo iluminado con luces de neón">

            @error('imagen_descripcion')
                <div class="text-danger fw-bold mt-1" id="error_imagen_descripcion">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="mb-4">
        <label for="contenido" class="form-label text-vhs-yellow fw-bold">CONTENIDO DEL ARCHIVO</label>
        <textarea class="form-control bg-dark text-light border-secondary @error('contenido') is-invalid @enderror"
                  id="contenido"
                  name="contenido"
                  @error('contenido')
                      aria-invalid="true"
                      aria-errormessage="error_contenido"
                  @enderror
                  rows="10"
                  placeholder="Redacta el contenido desclasificado aquí...">{{ old('contenido', $post?->contenido) }}</textarea>

        @error('contenido')
            <div class="text-danger fw-bold mt-1" id="error_contenido">{{ $message }}</div>
        @enderror
    </div>

    <div class="d-grid gap-2">
        <button type="submit" class="btn btn-vhs-yellow fw-bold">
            [ {{ $post ? 'ACTUALIZAR REGISTRO' : 'PUBLICAR ENTRADA' }} ]
        </button>
        <a href="{{ route('posts.listado') }}" class="btn btn-outline-danger btn-sm">
            ABORTAR OPERACIÓN
        </a>
    </div>
</form>
