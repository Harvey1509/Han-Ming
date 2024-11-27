<div class="pagination" aria-label="Navegación de paginación">
    <button {{ $currentPage == 1 ? 'disabled' : '' }} aria-label="Página anterior">
        <x-icon name="chevron_left" />
    </button>

    @foreach ($pages as $page)
        @if (is_numeric($page))
            <button class="{{ $currentPage == $page ? 'active' : '' }}" aria-label="Página {{ $page }}">
                {{ $page }}
            </button>
        @else
            <span class="pagination__ellipsis" aria-hidden="true">{{ $page }}</span>
        @endif
    @endforeach

    <button {{ $currentPage == count($pages) ? 'disabled' : '' }} aria-label="Página siguiente">
        <x-icon name="chevron_right" />
    </button>
</div>
