@extends('layouts.ecommerce')

@section('title', 'Inicio')

@push('styles')
    <link rel="stylesheet" href="/css/components/ecommerce/pages/home.css">
    <link rel="stylesheet" href="/css/components/ecommerce/slider.css">
@endpush

@section('content')
@include('components.ecommerce.slider')
<section class="cat-dest container">
    <div class="cat-dest__cabecera">
        <div>
            <small>Categorias destacadas</small>
            <h2>Explora nuestras categorias</h2>
            <p>Encuentra lo que necesitas en un solo lugar</p>
        </div>
        <a href="#" class="primary-button">Explorar</a>
    </div>
    <div class="cat-dest__categorias">
        <div class="cat-dest__categoria"></div>
        <div class="cat-dest__categoria"></div>
        <div class="cat-dest__categoria"></div>
        <div class="cat-dest__categoria"></div>
        <div class="cat-dest__categoria"></div>
        <div class="cat-dest__categoria"></div>
        <div class="cat-dest__categoria"></div>
        <div class="cat-dest__categoria"></div>
        <div class="cat-dest__categoria"></div>
        <div class="cat-dest__categoria"></div>
        <div class="cat-dest__categoria"></div>
        <div class="cat-dest__categoria"></div>
    </div>
</section>
<section class="ofertas container">
    <div class="ofertas__cabecera">
        <small>Ofertas</small>
        <h2>Ofertas exclusivas de temporada</h2>
        <p>No te pierdas nuestros precios especiales</p>
    </div>
    <div class="ofertas__imagenes">
        <div class="ofertas__imagen"></div>
        <div class="ofertas__imagen"></div>
        <div class="ofertas__imagen"></div>
        <div class="ofertas__imagen"></div>
        <div class="ofertas__imagen"></div>
        <div class="ofertas__imagen"></div>
    </div>
    <div class="ofertas__botones">
        <a href="#" class="primary-button">Saber más</a>
        <a href="#" class="secondary-button">Ver productos</a>
    </div>
</section>
<section class="publicidad container">
    <div class="publicidad__imagen"></div>
</section>
<section class="promocion container">
    <div class="cabecera">
        <h2>Promociones</h2>
    </div>
    <div class="promocion__imagenes">
        <div class="promocion__imagen"></div>
        <div class="promocion__imagen"></div>
    </div>
</section>
<div class="suscribete__wrapper">
    <section class="suscribete container">
        <div class="suscribete__cabecera">
            <small>Suscribete</small>
            <h2>Descubre nuestros productos exclusivos</h2>
            <p>Explora nuestra amplia selección de productos de importación</p>
        </div>
        <form class="suscribete__formulario">
            <div class="suscribete__input-box">
                <x-input
                label="Correo Electrónico"
                placeholder="Ingrese su correo electrónico" />
                <button type="submit" class="primary-button">Suscribirme</button>
            </div>
            <small>Al hacer clic en Suscribirme, confirmas que estás de acuerdo con
                nuestros Términos y Condiciones.</small>
        </form>
    </section>
</div>
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