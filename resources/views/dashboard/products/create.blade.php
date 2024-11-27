<!-- create.blade.php -->
@extends('layouts.dashboard')

@section('title', 'Crear Producto')

@push('styles')
<link rel="stylesheet" href="/css/components/dashboard/form.css">
@endpush

@section('main-content')
<div class="main-content__panel">
    <div class="main-content__form-wrapper">
        <h3>Crear nuevo producto</h3>
        <form action="{{ route('products.store') }}" class="form-content form-products" method="POST" id="createForm"
            enctype="multipart/form-data">
            @csrf
            <div class="form-column form-products-column inputs">
                <x-input type="text" label="Nombre" name="nombre_producto" placeholder="Ingrese el nombre del producto" required />
                <x-form.select-field name="subcategoria_producto" label="Subcategoría perteneciente" text="Elija una subcategoría" :options="$subcategorias" :currentOption="null" />
                <x-input type="text" label="Precio" name="precio_producto" placeholder="Ingrese el precio del producto" required />
                <x-textarea label="Descripción" name="descripcion_producto" placeholder="Ingrese la descripción del producto" required />
            </div>
            <div class="form-column form-products-column image">
                <x-form.file-upload name="imagen_producto" label="Subir Imagen" />
            </div>
        </form>
        <div class="form-content__buttons">
            <button class="form-content__button form-content__button--submit" type="submit"
                form="createForm">Crear</button>
            <a href="{{ route('products.index') }}" class="form-content__button form-content__button--back">Regresar</a>
        </div>
    </div>
</div>

@endsection