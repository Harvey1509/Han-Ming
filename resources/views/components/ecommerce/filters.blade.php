<aside class="productos__sidebar">
    <div class="productos__sidebar-filtros">
        <!-- Filtro de Categorías -->
        <div class="productos__sidebar-filtro">
            <h4>Categorías</h4>
            <ul class="sidebar__categorias">
                <li>
                    <button class="button all-button" id="all-products-button">TODOS LOS PRODUCTOS</button>
                </li>
                @foreach($categorias as $categoria)
                <li>
                    <button class="button category-button" aria-expanded="false">
                        {{$categoria->nombre_categoria}}
                        <span class="material-symbols-outlined dropdown">
                            keyboard_arrow_up
                        </span>
                    </button>
                    <ul class="subcategorias" hidden>
                        @foreach($categoria->subcategorias as $subcategoria)
                        <li class="subcategoria-item">
                            <button class="button subcategory-button" data-subcategory-id="{{$subcategoria->id}}">
                                {{$subcategoria->nombre_subcategoria}}
                            </button>
                        </li>
                        @endforeach
                    </ul>
                </li>
                @endforeach
            </ul>
        </div>

        <!-- Filtro de Precio -->
        <div class="productos__sidebar-filtro price-filter">
            <h4>Precio</h4>
            <div class="price-filter-options">
                <div class="price-filter-buttons-wrapper">
                    <button class="price-filter-button-sign" data-sign="lt">Menor</button>
                    <button class="price-filter-button-sign" data-sign="eq">Igual</button>
                    <button class="price-filter-button-sign" data-sign="gt">Mayor</button>
                </div>
                <button class="price-filter-button" data-price="10">S/10</button>
                <button class="price-filter-button" data-price="25">S/25</button>
                <button class="price-filter-button" data-price="50">S/50</button>
                <button class="price-filter-button" data-price="100">S/100</button>
                <button class="price-filter-button" data-price="200">S/200</button>
                <input class="price-filter-input" type="number" id="precio" placeholder="Precio para filtrar...">
            </div>
        </div>

        <div class="active-filters">
            <h4>Filtros Activos:</h4>
            <ul id="active-filters-list"></ul>
        </div>

    </div>
</aside>