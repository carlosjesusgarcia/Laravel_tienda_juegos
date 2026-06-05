<nav class="navbar navbar-expand-lg navbar-dark bg-black border-bottom border-danger py-3">
    <div class="container">
        <a class="navbar-brand text-danger fw-bold stranger-text" href="{{ route('home') }}">🕹️ Retro Games</a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto align-items-center">
                <li class="nav-item">
                    <x-nav-link active-route="home">Inicio</x-nav-link>
                </li>

                <li class="nav-item">
                    <x-nav-link active-route="nosotros">Nosotros</x-nav-link>
                </li>

                <li class="nav-item">
                    <x-nav-link active-route="juegos.listado">Catálogo</x-nav-link>
                </li>

                <li class="nav-item">
                    <x-nav-link active-route="posts.listado">Blog</x-nav-link>
                </li>

                {{-- @guest muestra su contenido solo a los usuarios NO logueados --}}
                @guest
                    <li class="nav-item">
                        <x-nav-link active-route="login">Login</x-nav-link>
                    </li>
                @endguest

                {{-- @auth muestra su contenido solo a los usuarios SÍ logueados --}}
                @auth
                    <li class="nav-item ms-lg-2">
                        <form action="{{ route('logout') }}" method="POST" class="m-0 p-0">
                            @csrf
                            <button type="submit" class="nav-link text-danger fw-bold bg-transparent border-0" style="cursor: pointer;">
                                {{ auth()->user()->name }} (Cerrar Sesión)
                            </button>
                        </form>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>
