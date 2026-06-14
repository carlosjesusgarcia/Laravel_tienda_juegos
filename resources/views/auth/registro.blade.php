{{--
/**
 * Archivo: registro.blade.php
 * Función: Plantilla de presentación encargada de renderizar la interfaz gráfica del formulario de registro para nuevos usuarios comunes de la tienda.
 */
--}}
<x-principal-layout>
    <x-slot:title>Registro</x-slot:title>

    <div class="d-flex flex-column justify-content-center align-items-center my-5">
        <h1 class="display-4 fw-bold text-danger mb-4 text-center" style="text-shadow: 0 0 10px #ff0000;">
            [REGISTRO DE JUGADOR]
        </h1>

        <p class="lead text-secondary mb-4 text-center">
            Creá tu cuenta para comprar juegos y consultar tu historial.
        </p>

        <div class="card bg-black border-secondary w-100" style="max-width: 400px;">
            <div class="card-body p-4">
                <form action="{{ route('registro.guardar') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label for="nameInput" class="form-label text-info">Nombre de Usuario</label>
                        <input
                            type="text"
                            name="name"
                            class="form-control bg-dark text-light border-secondary"
                            id="nameInput"
                            placeholder="Jugador Retro"
                            value="{{ old('name') }}"
                            required
                        >

                        @error('name')
                            <div class="text-danger fw-bold mt-1">{{ $message }}</div>
                        @enderror
                    </div>

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

                        @error('email')
                            <div class="text-danger fw-bold mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="passwordInput" class="form-label text-info">Contraseña</label>
                        <input
                            type="password"
                            name="password"
                            class="form-control bg-dark text-light border-secondary"
                            id="passwordInput"
                            placeholder="********"
                            required
                        >

                        @error('password')
                            <div class="text-danger fw-bold mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="passwordConfirmationInput" class="form-label text-info">Confirmar Contraseña</label>
                        <input
                            type="password"
                            name="password_confirmation"
                            class="form-control bg-dark text-light border-secondary"
                            id="passwordConfirmationInput"
                            placeholder="********"
                            required
                        >
                    </div>

                    <button type="submit" class="btn btn-outline-warning w-100 fw-bold">
                        CREAR CUENTA
                    </button>
                </form>

                <div class="mt-4 text-center">
                    <a href="{{ route('login') }}" class="text-secondary">
                        Ya tengo cuenta
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-principal-layout>
