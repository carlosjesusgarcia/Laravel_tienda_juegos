{{--
/**
 * Archivo: registro.blade.php
 * Función: Plantilla de presentación encargada de renderizar
 * la interfaz gráfica del formulario de registro de usuarios.
 */
--}}
<x-principal-layout>
    <x-slot:title>Registro</x-slot:title>

    <section
        class="d-flex flex-column justify-content-center align-items-center my-5"
        aria-labelledby="titulo-registro"
    >
        <h1
            id="titulo-registro"
            class="display-4 fw-bold text-danger mb-4 text-center"
            style="text-shadow: 0 0 10px #ff0000;"
        >
            [REGISTRO DE JUGADOR]
        </h1>

        <p class="lead text-secondary mb-4 text-center">
            Creá tu cuenta para comprar juegos, guardar tu historial y seguir disfrutando del catálogo.
        </p>

        <div
            class="card border-secondary w-100"
            style="max-width: 400px;"
        >
            <div class="card-body p-4">
                <form
                    action="{{ route('registro.guardar') }}"
                    method="POST"
                    novalidate
                >
                    @csrf

                    <div class="mb-3">
                        <label
                            for="nameInput"
                            class="form-label text-info"
                        >
                            Nombre de usuario
                        </label>

                        <input
                            type="text"
                            name="name"
                            id="nameInput"
                            class="form-control bg-dark text-light border-secondary"
                            placeholder="Jugador Retro"
                            value="{{ old('name') }}"
                            autocomplete="username"
                        >

                        @error('name')
                            <div class="text-danger fw-bold mt-1">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label
                            for="emailInput"
                            class="form-label text-info"
                        >
                            Correo electrónico
                        </label>

                        <input
                            type="email"
                            name="email"
                            id="emailInput"
                            class="form-control bg-dark text-light border-secondary"
                            placeholder="jugador1@ejemplo.com"
                            value="{{ old('email') }}"
                            autocomplete="email"
                        >

                        @error('email')
                            <div class="text-danger fw-bold mt-1">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label
                            for="passwordInput"
                            class="form-label text-info"
                        >
                            Contraseña
                        </label>

                        <input
                            type="password"
                            name="password"
                            id="passwordInput"
                            class="form-control bg-dark text-light border-secondary"
                            placeholder="********"
                            autocomplete="new-password"
                        >

                        @error('password')
                            <div class="text-danger fw-bold mt-1">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label
                            for="passwordConfirmationInput"
                            class="form-label text-info"
                        >
                            Confirmar contraseña
                        </label>

                        <input
                            type="password"
                            name="password_confirmation"
                            id="passwordConfirmationInput"
                            class="form-control bg-dark text-light border-secondary"
                            placeholder="********"
                            autocomplete="new-password"
                        >
                    </div>

                    <button
                        type="submit"
                        class="btn btn-outline-warning w-100 fw-bold"
                    >
                        CREAR CUENTA
                    </button>
                </form>

                <div class="mt-4 text-center">
                    <a
                        href="{{ route('login') }}"
                        class="text-secondary"
                    >
                        Ya tengo una cuenta
                    </a>
                </div>
            </div>
        </div>
    </section>
</x-principal-layout>