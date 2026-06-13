{{--
/**
 * Archivo: login.blade.php
 * Función: Plantilla de presentación encargada de renderizar la interfaz gráfica del formulario de autenticación para el personal del sistema.
 */
--}}
<x-principal-layout>
    <x-slot:title>Login</x-slot:title>

    <div class="d-flex flex-column justify-content-center align-items-center my-5">
        <h1 class="display-4 fw-bold text-danger mb-4 text-center" style="text-shadow: 0 0 10px #ff0000;">
            [ZONA RESTRINGIDA]
        </h1>

        <p class="lead text-secondary mb-4 text-center">
            Acceso exclusivo para personal de la tienda arcade.
        </p>

        <div class="card bg-black border-secondary w-100" style="max-width: 400px;">
            <div class="card-body p-4">
                <form action="{{ route('login.process') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label for="emailInput" class="form-label text-info">Correo Electrónico</label>
                        <input
                            type="email"
                            name="email"
                            class="form-control bg-dark text-light border-secondary"
                            id="emailInput"
                            placeholder="jugador1@ejemplo.com"
                            value="{{ old('email') }}"
                            required
                        >
                    </div>

                    <div class="mb-4">
                        <label for="passwordInput" class="form-label text-info">Contraseña</label>
                        <input
                            type="password"
                            name="password"
                            class="form-control bg-dark text-light border-secondary"
                            id="passwordInput"
                            placeholder="********"
                            required
                        >
                    </div>

                    <button type="submit" class="btn btn-outline-warning w-100 fw-bold">
                        INICIAR SESIÓN
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-principal-layout>
