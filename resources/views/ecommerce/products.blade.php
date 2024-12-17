@extends('layouts.ecommerce')

@section('title', 'Productos')

@push('styles')
<link rel="stylesheet" href="/css/components/ecommerce/pages/products.css">
<link rel="stylesheet" href="/css/components/ecommerce/slider.css">
@endpush

@section('content')

@include('components.ecommerce.slider', ['height' => '250px'])

<div class="productos">
    @include('components.ecommerce.filters', ['categorias' => $categorias])

    <section class="productos__contenido">
        <x-search icon_left placeholder="Buscar productos..." id="search-input" />
        <div class="productos__imagenes" id="productos__renderizar"></div>
        <div class="pagination" id="productos__paginacion"></div>
    </section>
</div>


@push('scripts')

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const productsContainer = document.getElementById('productos__renderizar');
        const paginationContainer = document.getElementById('productos__paginacion');
        const searchInput = document.getElementById('search-input');


        const allProductsButton = document.getElementById('all-products-button');
        const priceButtons = document.querySelectorAll('.price-filter-button');
        const priceSignButtons = document.querySelectorAll('.price-filter-button-sign');
        const customPriceInput = document.getElementById('precio');
        const subcategoryButtons = document.querySelectorAll('.subcategory-button');
        const activeFiltersList = document.getElementById('active-filters-list');

        initializeCategoryToggle();
        initializeEventListeners();
        renderProducts();

        let debounceTimeout;

        if (searchInput) {
            searchInput.addEventListener('input', () => {
                clearTimeout(debounceTimeout);
                debounceTimeout = setTimeout(() => {
                    const searchQuery = searchInput.value.trim();
                    console.log(searchQuery);
                    applyFilters(searchQuery);
                }, 500);
            });
        }

        async function renderProducts(filters = '', page = 1) {
            try {
                const response = await fetch(`/api/v1/productos?page=${page}&${filters}`);
                const data = await response.json();

                productsContainer.innerHTML = '';

                data.data.forEach(product => {
                    const productDiv = document.createElement('div');
                    productDiv.classList.add('productos__imagen');
                    productDiv.innerHTML = `
                        <img src="${product.imagen}" alt="${product.nombre}">
                        <div class="producto__detalles">
                            <p class="producto__nombre">${product.nombre}</p>
                            <p class="producto__descripcion">${product.descripcion}</p>
                            <h4 class="producto__precio" data-id="${product.id}" data-precio="${product.precio}">S/ ${product.precio}</h4>
                            @auth
                                <button class="producto__carrito" data-id="${product.id}" data-precio="${product.precio}">Agregar al Carrito</button>
                            @else
                                <button class="producto__carrito producto__carrito--login">Inicia sesión para comprar</button>
                            @endauth
                        </div>
                    `;
                    productsContainer.appendChild(productDiv);
                });

                renderPagination(data.meta);
            } catch (error) {
                console.error('Error loading products:', error);
            }
        }

        function renderPagination(meta) {
            paginationContainer.innerHTML = '';

            const prevButton = document.createElement('button');
            prevButton.textContent = '<';
            prevButton.classList.add('pagination-btn');
            prevButton.id = 'prev-btn';
            prevButton.disabled = meta.current_page === 1;
            prevButton.addEventListener('click', () => renderProducts('', meta.current_page - 1));
            paginationContainer.appendChild(prevButton);

            meta.links.forEach(link => {
                if (link.label === '&laquo; Previous' || link.label === 'Next &raquo;') return;

                const pageButton = document.createElement('button');
                pageButton.textContent = link.label;
                pageButton.classList.add('pagination-number');
                if (link.active) pageButton.classList.add('active');
                pageButton.disabled = link.active;
                pageButton.addEventListener('click', () => {
                    const page = new URL(link.url).searchParams.get('page');
                    renderProducts('', page);
                });
                paginationContainer.appendChild(pageButton);
            });

            const nextButton = document.createElement('button');
            nextButton.textContent = '>';
            nextButton.classList.add('pagination-btn');
            nextButton.id = 'next-btn';
            nextButton.disabled = meta.current_page === meta.last_page;
            nextButton.addEventListener('click', () => renderProducts('', meta.current_page + 1));
            paginationContainer.appendChild(nextButton);
        }

        function applyFilters(searchQuery = '') {
            let filters = [];
            activeFiltersList.innerHTML = '';

            const activeSubcategory = document.querySelector('.subcategory-button.active');
            if (activeSubcategory) {
                const subcategoryId = activeSubcategory.dataset.subcategoryId;
                filters.push(`subcategoria[eq]=${subcategoryId}`);
                addActiveFilter(`Subcategoría: ${activeSubcategory.textContent.trim()}`, () => {
                    activeSubcategory.classList.remove('active');
                    applyFilters();
                });
            }

            const activePriceSign = document.querySelector('.price-filter-button-sign.active');
            const activePrice = document.querySelector('.price-filter-button.active');
            if (activePrice && activePriceSign) {
                const priceSign = activePriceSign.dataset.sign;
                const priceValue = activePrice.dataset.price;
                filters.push(`precio[${priceSign}]=${priceValue}`);
                addActiveFilter(
                    `${priceSign === 'gt' ? 'Mayor a' : priceSign === 'lt' ? 'Menor a' : 'Igual a'} S/${priceValue}`,
                    () => {
                        activePrice.classList.remove('active');
                        activePriceSign.classList.remove('active');
                        applyFilters();
                    }
                );
            }

            const customPriceValue = customPriceInput.value;
            if (customPriceValue) {
                const activeSign = document.querySelector('.price-filter-button-sign.active');
                const priceSign = activeSign ? activeSign.dataset.sign : 'eq';
                filters.push(`precio[${priceSign}]=${customPriceValue}`);
                addActiveFilter(
                    `${priceSign === 'gt' ? 'Mayor a' : priceSign === 'lt' ? 'Menor a' : 'Igual a'} S/${customPriceValue}`,
                    () => {
                        customPriceInput.value = '';
                        applyFilters();
                    }
                );
            }

            if (searchQuery) {
                filters.push(`nombre[like]=${encodeURIComponent(searchQuery)}`);
            }

            renderProducts(filters.join('&'));
        }

        function addActiveFilter(label, removeCallback) {
            const filterItem = document.createElement('li');
            filterItem.textContent = label;
            filterItem.addEventListener('click', removeCallback);
            activeFiltersList.appendChild(filterItem);
        }

        function resetFilters() {
            customPriceInput.value = '';
            document.querySelectorAll('.subcategory-button, .price-filter-button, .price-filter-button-sign').forEach(button => {
                button.classList.remove('active');
            });
            activeFiltersList.innerHTML = '';
            renderProducts();
        }

        function initializeCategoryToggle() {
            document.querySelectorAll('.category-button').forEach(button => {
                button.addEventListener('click', () => {
                    const subcategories = button.nextElementSibling;
                    const isExpanded = button.getAttribute('aria-expanded') === 'true';
                    button.setAttribute('aria-expanded', !isExpanded);

                    if (isExpanded) {
                        subcategories.setAttribute('hidden', '');
                    } else {
                        subcategories.removeAttribute('hidden');
                    }

                    const arrow = button.querySelector('.material-symbols-outlined');
                    arrow.classList.toggle('rotate');
                });
            });
        }

        function initializeEventListeners() {
            priceButtons.forEach(button => {
                button.addEventListener('click', () => toggleActiveButton(button, priceButtons, applyFilters));
            });

            priceSignButtons.forEach(button => {
                button.addEventListener('click', () => toggleActiveButton(button, priceSignButtons, applyFilters));
            });

            customPriceInput.addEventListener('input', () => {
                priceButtons.forEach(btn => btn.classList.remove('active'));
                applyFilters();
            });

            subcategoryButtons.forEach(button => {
                button.addEventListener('click', () => toggleActiveButton(button, subcategoryButtons, applyFilters));
            });

            allProductsButton.addEventListener('click', resetFilters);

            productsContainer.addEventListener('click', handleAddToCart);
        }

        async function handleAddToCart(event) {
            if (event.target.classList.contains('producto__carrito--login')) {
                window.location.href = "{{ route('login') }}";
                return;
            }
            if (event.target.classList.contains('producto__carrito')) {
                const button = event.target;
                const productId = button.getAttribute('data-id');
                const response = await fetch("{{ route('shop.agregarProducto') }}", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    },
                    body: JSON.stringify({
                        id_producto: productId,
                        cantidad: 1
                    }),
                });

                if (response.ok) {
                    fetchCart();
                } else {
                    console.error('Error al agregar producto al carrito.');
                }
            }
        }

        function toggleActiveButton(button, buttonGroup, callback) {
            if (button.classList.contains('active')) {
                button.classList.remove('active');
            } else {
                buttonGroup.forEach(btn => btn.classList.remove('active'));
                button.classList.add('active');
            }
            callback();
        }
    });
</script>
@endpush
@endsection