@props(['juego' => null])

{{--
 | Componente de Formulario: Creación y Edición de Juegos
 |
 | Implementa:
 | - Persistencia de datos mediante el helper old().
 | - Retroalimentación visual de errores (clase is-invalid de Bootstrap).
 | - Estándares de Accesibilidad (WAI-ARIA) para lectores de pantalla.
 --}}
<form action="{{ route('juegos.guardar') }}" method="POST" class="text-light">
    @csrf

    {{-- Condicional para el método HTTP correcto en caso de actualización --}}
    @if($juego)
        @method('PUT')
    @endif

    <div class="mb-3">
        <label for="titulo" class="form-label text-vhs-yellow fw-bold">TÍTULO DEL JUEGO</label>
        {{--
         | Atributos ARIA:
         | aria-invalid: Anuncia al lector de pantalla si el valor actual es inválido.
         | aria-errormessage: Vincula el input con el ID del contenedor que posee el mensaje de error.
         --}}
        <input type="text"
               class="form-control bg-dark text-light border-secondary @error('titulo') is-invalid @enderror"
               id="titulo"
               name="titulo"
               @error('titulo')
                   aria-invalid="true"
                   aria-errormessage="error_titulo"
               @enderror
               value="{{ old('titulo', $juego?->titulo) }}"
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
                   value="{{ old('precio', $juego?->precio) }}"
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
                   value="{{ old('fecha_lanzamiento', $juego?->fecha_lanzamiento) }}">

            @error('fecha_lanzamiento')
                <div class="text-danger fw-bold mt-1" id="error_fecha_lanzamiento">{{ $message }}</div>
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
                  placeholder="Describe la misión del cartucho...">{{ old('sinopsis', $juego?->sinopsis) }}</textarea>

        @error('sinopsis')
            <div class="text-danger fw-bold mt-1" id="error_sinopsis">{{ $message }}</div>
        @enderror
    </div>

    <div class="d-grid gap-2">
        <button type="submit" class="btn btn-vhs-yellow fw-bold">
            [ {{ $juego ? 'ACTUALIZAR NÚCLEO' : 'GUARDAR EN EL ARCHIVO' }} ]
        </button>
        <a href="{{ route('juegos.listado') }}" class="btn btn-outline-danger btn-sm">
            ABORTAR OPERACIÓN
        </a>
    </div>
</form>
