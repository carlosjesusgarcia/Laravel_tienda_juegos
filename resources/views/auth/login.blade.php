{{--
/**
 * Archivo: login.blade.php
 * Función: Plantilla de presentación encargada de renderizar
 * la interfaz gráfica del formulario de autenticación.
 */
--}}
<x-principal-layout>
    <x-slot:title>Login</x-slot:title>

    <section
        class="d-flex flex-column justify-content-center align-items-center my-5"
        aria-labelledby="titulo-login"
    >
        <h1
            id="titulo-login"
            class="display-4 fw-bold text-danger mb-4 text-center"
            style="text-shadow: 0 0 10px #ff0000;"
        >
            [ZONA RESTRINGIDA]
        </h1>

        <p class="lead text-secondary mb-4 text-center">
            Ingresá con tu correo electrónico y contraseña para acceder a tu cuenta.
        </p>

        <div
            class="card border-secondary w-100"
            style="max-width: 400px;"
        >
            <div class="card-body p-4">
                <form
                    action="{{ route('login.process') }}"
                    method="POST"
                    novalidate
                >
                    @csrf

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
                    </div>

                    <div class="mb-4">
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
                            autocomplete="current-password"
                        >
                    </div>

                    <button
                        type="submit"
                        class="btn btn-outline-warning w-100 fw-bold"
                    >
                        INICIAR SESIÓN
                    </button>
                </form>
            </div>
        </div>
    </section>
</x-principal-layout>