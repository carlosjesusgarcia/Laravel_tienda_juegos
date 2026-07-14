<a
    class="nav-link {{ request()->routeIs($activeRoute) ? 'active' : '' }}"
    href="{{ route($activeRoute) }}"
    @if(request()->routeIs($activeRoute))
        aria-current="page"
    @endif
>
    {{ $slot }}
</a>