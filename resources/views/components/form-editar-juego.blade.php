@props(['juego'])

<form action="{{ route('juegos.actualizar', $juego) }}" method="POST" class="text-light" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label for="titulo" class="form-label text-vhs-yellow fw-bold">TÍTULO DEL JUEGO</label>
        <input type="text"
               class="form-control bg-dark text-light border-secondary @error('titulo') is-invalid @enderror"
               id="titulo"
               name="titulo"
               @error('titulo')
                   aria-invalid="true"
                   aria-errormessage="error_titulo"
               @enderror
               value="{{ old('titulo', $juego->titulo) }}"
               placeholder="Ej: Space Invaders">

        @error('titulo')
            <div class="text-danger fw-bold mt-1" id="error_titulo">{{ $message }}</div>
        @enderror
    </div>

    <div class="row">
        <div class="col-md-6 mb-3">
            <label for="precio" class="form-label text-vhs-yellow fw-bold">PRECIO (ARS)</label>
            <input type="number"
                   class="form-control bg-dark text-light border-secondary @error('precio') is-invalid @enderror"
                   id="precio"
                   name="precio"
                   @error('precio')
                       aria-invalid="true"
                       aria-errormessage="error_precio"
                   @enderror
                   value="{{ old('precio', $juego->precio) }}"
                   placeholder="250000">

        @error('precio')
            <div class="text-danger fw-bold mt-1" id="error_precio">{{ $message }}</div>
        @enderror
    </div>

        <div class="col-md-6 mb-3">
            <label for="fecha_lanzamiento" class="form-label text-vhs-yellow fw-bold">FECHA DE LANZAMIENTO</label>
            <input type="date"
                   class="form-control bg-dark text-light border-secondary @error('fecha_lanzamiento') is-invalid @enderror"
                   id="fecha_lanzamiento"
                   name="fecha_lanzamiento"
                   @error('fecha_lanzamiento')
                       aria-invalid="true"
                       aria-errormessage="error_fecha_lanzamiento"
                   @enderror
                   value="{{ old('fecha_lanzamiento', $juego->fecha_lanzamiento) }}">

            @error('fecha_lanzamiento')
                <div class="text-danger fw-bold mt-1" id="error_fecha_lanzamiento">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 mb-3">
    <label for="portada" class="form-label text-vhs-yellow fw-bold">PORTADA DEL JUEGO</label>

    <input type="file"
           class="form-control bg-dark text-light border-secondary @error('portada') is-invalid @enderror"
           id="portada"
           name="portada"
           aria-describedby="help_portada"
           @error('portada')
               aria-invalid="true"
               aria-errormessage="error_portada"
           @enderror>

    <div id="help_portada" class="form-text text-secondary mt-1">
        Solo elegí una portada si querés cambiar la actual.
    </div>

    @error('portada')
        <div class="text-danger fw-bold mt-1" id="error_portada">
            {{ $message }}
        </div>
    @enderror

    <div class="mt-3">
        <span>Portada actual:</span>

        @if($juego->portada !== null && \Storage::exists($juego->portada))
            <img src="{{ \Storage::url($juego->portada) }}"
                 alt="{{ $juego->portada_descripcion }}"
                 class="img-fluid mt-2">
        @else
            <p class="text-secondary mb-0">No tiene una portada actualmente.</p>
        @endif
    </div>
</div>

        <div class="col-md-6 mb-3">
            <label for="portada_descripcion" class="form-label text-vhs-yellow fw-bold">DESCRIPCIÓN DE IMAGEN</label>
            <input type="text"
                   class="form-control bg-dark text-light border-secondary @error('portada_descripcion') is-invalid @enderror"
                   id="portada_descripcion"
                   name="portada_descripcion"
                   @error('portada_descripcion')
                       aria-invalid="true"
                       aria-errormessage="error_portada_descripcion"
                   @enderror
                   value="{{ old('portada_descripcion', $juego->portada_descripcion) }}"
                   placeholder="Ej: Cartucho original de Space Invaders">

            @error('portada_descripcion')
                <div class="text-danger fw-bold mt-1" id="error_portada_descripcion">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="mb-4">
        <label for="sinopsis" class="form-label text-vhs-yellow fw-bold">SINOPSIS DEL ARCHIVO</label>
        <textarea class="form-control bg-dark text-light border-secondary @error('sinopsis') is-invalid @enderror"
                  id="sinopsis"
                  name="sinopsis"
                  @error('sinopsis')
                      aria-invalid="true"
                      aria-errormessage="error_sinopsis"
                  @enderror
                  rows="5"
                  placeholder="Describe la misión del cartucho...">{{ old('sinopsis', $juego->sinopsis) }}</textarea>

        @error('sinopsis')
            <div class="text-danger fw-bold mt-1" id="error_sinopsis">{{ $message }}</div>
        @enderror
    </div>

    <div class="d-grid gap-2">
        <button type="submit" class="btn btn-vhs-yellow fw-bold">
            [ ACTUALIZAR NÚCLEO ]
        </button>
        <a href="{{ route('juegos.listado') }}" class="btn btn-outline-danger btn-sm">
            ABORTAR OPERACIÓN
        </a>
    </div>
</form>
