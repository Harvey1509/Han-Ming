<div class="main-content__header">
    <h3>{{ $title }}</h3>

    <div class="main-content__header-wrapper">
        <x-search
        class="main-content__header-search"
        icon_left
        placeholder="Buscar en la tabla..." />

        @php $prefix = $prefix ?? ''; @endphp

        <div class="main-content__header-functions">
            <x-dashboard.buttons.create :prefix="$prefix" />
        </div>
    </div>

    <div class="main-content__header-wrapper">
        <div class="main-content__header-filters">
            @foreach ($filters as $filter)
                <x-dashboard.buttons.filter :label="$filter['label']" />
            @endforeach
        </div>

        <div class="main-content__header-rows">
            <small>Filas por página:</small>
            <x-dashboard.buttons.rows-per-page :rowsPerPage="$rowsPerPage ?? '10'" />
        </div>
    </div>
</div>


<script>
    const fileImport = document.getElementById("fileImport");
    const buttonImport = document.getElementById("buttonImport");

    buttonImport.addEventListener("click", (event) => {
        event.preventDefault();
        fileImport.click();
    });

    fileImport.addEventListener("change", () => {
        fileImport.closest('form').submit();
    });
</script>