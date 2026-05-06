@props(['activeRoute'])

<a
    class="nav-link {{ request()->routeIs($activeRoute) ? 'active' : '' }}"
    {{ request()->routeIs($activeRoute) ? 'aria-current="page"' : '' }}
    href="{{ route($activeRoute) }}"
>
    {{ $slot }}
</a>
