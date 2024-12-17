@extends('layouts.ecommerce')

@section('title', 'Inicio')

@push('styles')
    <link rel="stylesheet" href="/css/components/ecommerce/pages/home.css">
    <link rel="stylesheet" href="/css/components/ecommerce/slider.css">
@endpush

@section('content')
@include('components.ecommerce.slider', ['height' => '450px'])
<section class="ofertas container">
    <div class="ofertas__cabecera">
        <small>Ofertas</small>
        <h2>Ofertas exclusivas de temporada</h2>
        <p>No te pierdas nuestros precios especiales</p>
    </div>
    <div class="ofertas__imagenes">
    @foreach ($ofertas_temporada as $oferta)
        <div class="ofertas__imagen">
            <img class="ofertas__img" src="{{ $oferta['url_imagen'] }}">
        </div>
    @endforeach
    </div>
    <div class="ofertas__botones">
        <a href="#" class="primary-button">Saber más</a>
        <a href="#" class="secondary-button">Ver productos</a>
    </div>
</section>
<section class="promocion container">
    <div class="promocion__cabecera">
        <h2>Promociones</h2>
    </div>
    <div class="promocion__imagenes">
        @for ($i = 0; $i < 2; $i++)
            <div class="promocion__imagen">
                <img class="promocion__img" src="{{ $promociones[0]['url_imagen'] }}">
            </div>
        @endfor
    </div>
</section>
<section class="socios-marcas container">
    <div class="socios-marcas__cabecera">
        <small>Socios comerciales</small>
        <h2>Nuestras marcas y socios</h2>
        <p>Trabajamos con las mejores marcas a nivel global y nacional</p>
    </div>
    <div class="socios-marcas__imagenes">
        <div class="socios-marcas__imagen"></div>
        <div class="socios-marcas__imagen"></div>
        <div class="socios-marcas__imagen"></div>
        <div class="socios-marcas__imagen"></div>
        <div class="socios-marcas__imagen"></div>
        <div class="socios-marcas__imagen"></div>
        <div class="socios-marcas__imagen"></div>
        <div class="socios-marcas__imagen"></div>
    </div>
</section>
@endsection