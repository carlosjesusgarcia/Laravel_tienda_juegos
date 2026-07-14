@props(['juego', 'ratings', 'generos'])

<form
    action="{{ route('juegos.actualizar', $juego) }}"
    method="POST"
    class="text-light"
    enctype="multipart/form-data"
    novalidate
>
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label
            for="titulo"
            class="form-label text-vhs-yellow fw-bold"
        >
            TÍTULO DEL JUEGO
        </label>

        <input
            type="text"
            id="titulo"
            name="titulo"
            class="form-control bg-dark text-light border-secondary @error('titulo') is-invalid @enderror"
            value="{{ old('titulo', $juego->titulo) }}"
            placeholder="Ej: Space Invaders"
            @error('titulo')
                aria-invalid="true"
                aria-errormessage="error_titulo"
            @enderror
        >

        @error('titulo')
            <div
                id="error_titulo"
                class="text-danger fw-bold mt-1"
                role="alert"
            >
                {{ $message }}
            </div>
        @enderror
    </div>

    <div class="row">
        <div class="col-md-6 mb-3">
            <label
                for="precio"
                class="form-label text-vhs-yellow fw-bold"
            >
                PRECIO (ARS)
            </label>

            <input
                type="number"
                id="precio"
                name="precio"
                class="form-control bg-dark text-light border-secondary @error('precio') is-invalid @enderror"
                value="{{ old('precio', $juego->precio) }}"
                placeholder="250000"
                @error('precio')
                    aria-invalid="true"
                    aria-errormessage="error_precio"
                @enderror
            >

            @error('precio')
                <div
                    id="error_precio"
                    class="text-danger fw-bold mt-1"
                    role="alert"
                >
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="col-md-6 mb-3">
            <label
                for="fecha_lanzamiento"
                class="form-label text-vhs-yellow fw-bold"
            >
                FECHA DE LANZAMIENTO
            </label>

            <input
                type="date"
                id="fecha_lanzamiento"
                name="fecha_lanzamiento"
                class="form-control bg-dark text-light border-secondary @error('fecha_lanzamiento') is-invalid @enderror"
                value="{{ old('fecha_lanzamiento', $juego->fecha_lanzamiento->format('Y-m-d')) }}"
                @error('fecha_lanzamiento')
                    aria-invalid="true"
                    aria-errormessage="error_fecha_lanzamiento"
                @enderror
            >

            @error('fecha_lanzamiento')
                <div
                    id="error_fecha_lanzamiento"
                    class="text-danger fw-bold mt-1"
                    role="alert"
                >
                    {{ $message }}
                </div>
            @enderror
        </div>
    </div>

    <div class="mb-3">
        <label
            for="rating_fk"
            class="form-label text-vhs-yellow fw-bold"
        >
            CLASIFICACIÓN DEL JUEGO
        </label>

        <select
            id="rating_fk"
            name="rating_fk"
            class="form-control bg-dark text-light border-secondary @error('rating_fk') is-invalid @enderror"
            @error('rating_fk')
                aria-invalid="true"
                aria-errormessage="error_rating_fk"
            @enderror
        >
            <option value="">Elegí una clasificación</option>

            @foreach($ratings as $rating)
                <option
                    value="{{ $rating->rating_id }}"
                    @if(old('rating_fk', $juego->rating_fk) == $rating->rating_id)
                        selected
                    @endif
                >
                    {{ $rating->nombre }} ({{ $rating->abreviatura }})
                </option>
            @endforeach
        </select>

        @error('rating_fk')
            <div
                id="error_rating_fk"
                class="text-danger fw-bold mt-1"
                role="alert"
            >
                {{ $message }}
            </div>
        @enderror
    </div>

    <fieldset class="mb-3 border-0 p-0">
        <legend class="form-label text-vhs-yellow fw-bold">
            GÉNERO DEL JUEGO
        </legend>

        <div class="row">
            @foreach($generos as $genero)
                <div class="col-md-6 mb-2">
                    <div class="form-check">
                        <input
                            type="checkbox"
                            id="genero_{{ $genero->genero_id }}"
                            name="generos[]"
                            value="{{ $genero->genero_id }}"
                            class="form-check-input @error('generos') is-invalid @enderror"
                            @checked(
                                in_array(
                                    $genero->genero_id,
                                    old(
                                        'generos',
                                        $juego->generos->pluck('genero_id')->toArray()
                                    )
                                )
                            )
                            @error('generos')
                                aria-invalid="true"
                                aria-errormessage="error_generos"
                            @enderror
                        >

                        <label
                            for="genero_{{ $genero->genero_id }}"
                            class="form-check-label text-light"
                        >
                            {{ $genero->nombre }}
                        </label>
                    </div>
                </div>
            @endforeach
        </div>

        @error('generos')
            <div
                id="error_generos"
                class="text-danger fw-bold mt-1"
                role="alert"
            >
                {{ $message }}
            </div>
        @enderror

        @error('generos.*')
            <div
                class="text-danger fw-bold mt-1"
                role="alert"
            >
                {{ $message }}
            </div>
        @enderror
    </fieldset>

    <div class="row">
        <div class="col-md-6 mb-3">
            <label
                for="portada"
                class="form-label text-vhs-yellow fw-bold"
            >
                PORTADA DEL JUEGO
            </label>

            <input
                type="file"
                id="portada"
                name="portada"
                class="form-control bg-dark text-light border-secondary @error('portada') is-invalid @enderror"
                accept="image/jpeg,image/png,image/webp"
                aria-describedby="ayuda_portada"
                @error('portada')
                    aria-invalid="true"
                    aria-errormessage="error_portada"
                @enderror
            >

            <div
                id="ayuda_portada"
                class="form-text text-secondary mt-1"
            >
                Elegí una imagen solamente si querés reemplazar la portada actual.
            </div>

            @error('portada')
                <div
                    id="error_portada"
                    class="text-danger fw-bold mt-1"
                    role="alert"
                >
                    {{ $message }}
                </div>
            @enderror

            <div class="mt-3">
                <p class="text-vhs-yellow fw-bold mb-2">
                    PORTADA ACTUAL
                </p>

                @if($juego->portada !== null && \Storage::exists($juego->portada))
                    <img
                        src="{{ \Storage::url($juego->portada) }}"
                        alt="{{ $juego->portada_descripcion ?? 'Portada actual del juego ' . $juego->titulo }}"
                        class="img-fluid rounded border border-secondary"
                    >
                @else
                    <p class="text-secondary mb-0">
                        Este juego no tiene una portada cargada actualmente.
                    </p>
                @endif
            </div>
        </div>

        <div class="col-md-6 mb-3">
            <label
                for="portada_descripcion"
                class="form-label text-vhs-yellow fw-bold"
            >
                DESCRIPCIÓN DE IMAGEN
            </label>

            <input
                type="text"
                id="portada_descripcion"
                name="portada_descripcion"
                class="form-control bg-dark text-light border-secondary @error('portada_descripcion') is-invalid @enderror"
                value="{{ old('portada_descripcion', $juego->portada_descripcion) }}"
                placeholder="Ej: Cartucho original de Space Invaders"
                @error('portada_descripcion')
                    aria-invalid="true"
                    aria-errormessage="error_portada_descripcion"
                @enderror
            >

            @error('portada_descripcion')
                <div
                    id="error_portada_descripcion"
                    class="text-danger fw-bold mt-1"
                    role="alert"
                >
                    {{ $message }}
                </div>
            @enderror
        </div>
    </div>

    <div class="mb-4">
        <label
            for="sinopsis"
            class="form-label text-vhs-yellow fw-bold"
        >
            SINOPSIS DEL ARCHIVO
        </label>

        <textarea
            id="sinopsis"
            name="sinopsis"
            class="form-control bg-dark text-light border-secondary @error('sinopsis') is-invalid @enderror"
            rows="5"
            placeholder="Describe la misión del cartucho..."
            @error('sinopsis')
                aria-invalid="true"
                aria-errormessage="error_sinopsis"
            @enderror
        >{{ old('sinopsis', $juego->sinopsis) }}</textarea>

        @error('sinopsis')
            <div
                id="error_sinopsis"
                class="text-danger fw-bold mt-1"
                role="alert"
            >
                {{ $message }}
            </div>
        @enderror
    </div>

    <div class="d-grid gap-2">
        <button
            type="submit"
            class="btn btn-vhs-yellow fw-bold"
        >
            [ ACTUALIZAR JUEGO ]
        </button>
    </div>
</form>