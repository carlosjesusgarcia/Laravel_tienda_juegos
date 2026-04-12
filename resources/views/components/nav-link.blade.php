<a
    class="nav-link {{ request()->is($to) ? 'active' : '' }}" {{ request()->is($to) ? 'aria-current="page"' : '' }}
    href="{{ url($to) }}"
>
    {{ $slot }}
</a>
