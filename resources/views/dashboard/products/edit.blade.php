<!-- edit.blade.php -->
@extends('layouts.dashboard')

@section('title', 'Editar producto')

@push('styles')
<link rel="stylesheet" href="/css/components/dashboard/form.css">
@endpush


@section('main-content')

<div class="main-content__panel">
    <div class="main-content__form-wrapper">
        <h3>Editar producto</h3>

        <form action="{{ route('products.update', $producto->id) }}" class="form-content form-products" method="POST"
            id="editForm" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-column form-products-column inputs">
                <x-input type="text" label="Id" value="{{ $producto->id }}" disabled />
                <x-form.select-field name="subcategoria_producto" label="Subcategoría perteneciente" text="Elija una subcategoría" :options="$subcategorias" :currentOption="$subcategoria_asociada->id" />
                <x-input type="text" label="Nombre nuevo" name="nombre_producto" value="{{ $producto->nombre_producto }}" />
                <x-input type="text" label="Precio" name="precio_producto" value="{{ $producto->precio_producto }}" />
                <x-textarea label="Descripcion" name="descripcion_producto" value="{{ $producto->descripcion_producto }}" />
            </div>
            <div class="form-column form-products-column image">
                <x-form.file-upload name="imagen_producto" label="Cambiar Imagen" :src="$producto->imagen_url_producto" />
            </div>
        </form>
        <div class="form-content__buttons">
            <button class="form-content__button form-content__button--submit" type="submit"
                form="editForm">Actualizar</button>
            <a href="{{ route('products.index') }}" class="form-content__button form-content__button--back">Regresar</a>
        </div>
    </div>
</div>


@endsection