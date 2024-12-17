<div class="main-content__header">
    <h3>{{ $title }}</h3>

    <div class="main-content__header-wrapper">
        <x-search class="main-content__header-search" icon_left placeholder="Buscar en la tabla..." id="search-box"
            value="{{ $search ?? '' }}" 
        />


        @php $prefix = $prefix ?? ''; @endphp

        <div class="main-content__header-functions">
            <x-dashboard.buttons.create :prefix="$prefix" />
        </div>
    </div>
    @if ($rowsPerPageButton)
    <div class="main-content__header-wrapper">
        <div class="main-content__header-rows">
            <small>Filas por página:</small>
            <x-dashboard.buttons.rows-per-page :rowsPerPage="$rowsPerPage"/>
        </div>
    </div>
    @endif
</div>