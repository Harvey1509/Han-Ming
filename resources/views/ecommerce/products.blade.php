@extends('layouts.ecommerce')

@section('title', 'Productos')

@push('styles')
<link rel="stylesheet" href="/css/components/ecommerce/pages/products.css">
<link rel="stylesheet" href="/css/components/ecommerce/slider.css">
@endpush

@section('content')
<section class="slider" style="height: 300px;">
    <div class="slider__images">
        <img src="/img/slider-1.jpg" class="slider__image" />
        <img src="/img/slider-2.jpg" class="slider__image" />
        <img src="/img/slider-3.jpg" class="slider__image" />
    </div>
    <div class="slider__navigation-buttons">
        <button class="slider__nav-button slider__nav-button--active"></button>
        <button class="slider__nav-button"></button>
        <button class="slider__nav-button"></button>
    </div>
</section>
<div class="productos">
    <aside class="productos__sidebar">
        <div class="productos__sidebar-filtros">
            <h2><i class="fas fa-filter"></i> Filtros</h2>

            <div class="productos__sidebar-filtro">
                <h4>Categorias</h4>
                <ul class="sidebar__categorias">
                    <li class="all-item">
                        <button class="all-button">TODOS LOS PRODUCTOS</button>
                    </li>
                    <li>
                        <button class="category-button" aria-expanded="false">
                            ELECTRODOMESTICOS
                            <span class="material-symbols-outlined dropdown">
                                keyboard_arrow_up
                            </span>
                        </button>
                        <ul class="subcategorias" hidden>
                            <li class="subcategoria-item">
                                <button class="subcategory-button" data-subcategory-id="1">
                                    WAFLERA
                                </button>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>

        </div>
    </aside>
    <section class="productos__contenido">
        <x-search
            icon_left
            placeholder="Buscar productos..." />
        <div class="productos__imagenes" id="productos__renderizar">
            <div class="productos__imagen">
                <img src="/img/producto.png" />
            </div>
            <div class="productos__imagen">
                <img src="/img/producto.png" />
            </div>
            <div class="productos__imagen">
                <img src="/img/producto.png" />
            </div>
            <div class="productos__imagen">
                <img src="/img/producto.png" />
            </div>
            <div class="productos__imagen">
                <img src="/img/producto.png" />
            </div>
            <div class="productos__imagen">
                <img src="/img/producto.png" />
            </div>
            <div class="productos__imagen">
                <img src="/img/producto.png" />
            </div>
            <div class="productos__imagen">
                <img src="/img/producto.png" />
            </div>
            <div class="productos__imagen">
                <img src="/img/producto.png" />
            </div>
            <div class="productos__imagen">
                <img src="/img/producto.png" />
            </div>
            <div class="productos__imagen">
                <img src="/img/producto.png" />
            </div>
            <div class="productos__imagen">
                <img src="/img/producto.png" />
            </div>
            <div class="productos__imagen">
                <img src="/img/producto.png" />
            </div>
            <div class="productos__imagen">
                <img src="/img/producto.png" />
            </div>
            <div class="productos__imagen">
                <img src="/img/producto.png" />
            </div>
            <div class="productos__imagen">
                <img src="/img/producto.png" />
            </div>
            <div class="productos__imagen">
                <img src="/img/producto.png" />
            </div>
            <div class="productos__imagen">
                <img src="/img/producto.png" />
            </div>
            <div class="productos__imagen">
                <img src="/img/producto.png" />
            </div>
            <div class="productos__imagen">
                <img src="/img/producto.png" />
            </div>
            <div class="productos__imagen">
                <img src="/img/producto.png" />
            </div>
            <div class="productos__imagen">
                <img src="/img/producto.png" />
            </div>
            <div class="productos__imagen">
                <img src="/img/producto.png" />
            </div>
            <div class="productos__imagen">
                <img src="/img/producto.png" />
            </div>
            <div class="productos__imagen">
                <img src="/img/producto.png" />
            </div>
            <div class="productos__imagen">
                <img src="/img/producto.png" />
            </div>
            <div class="productos__imagen">
                <img src="/img/producto.png" />
            </div>
            <div class="productos__imagen">
                <img src="/img/producto.png" />
            </div>
            <div class="productos__imagen">
                <img src="/img/producto.png" />
            </div>
            <div class="productos__imagen">
                <img src="/img/producto.png" />
            </div>
            <div class="productos__imagen">
                <img src="/img/producto.png" />
            </div>
            <div class="productos__imagen">
                <img src="/img/producto.png" />
            </div>
            <div class="productos__imagen">
                <img src="/img/producto.png" />
            </div>
            <div class="productos__imagen">
                <img src="/img/producto.png" />
            </div>
            <div class="productos__imagen">
                <img src="/img/producto.png" />
            </div>
            <div class="productos__imagen">
                <img src="/img/producto.png" />
            </div>
            <div class="productos__imagen">
                <img src="/img/producto.png" />
            </div>
        </div>
    </section>
</div>
@endsection