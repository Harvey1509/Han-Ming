@extends('layouts.dashboard')

@section('title', 'Crear Subcategoría')

@push('styles')
<link rel="stylesheet" href="/css/components/dashboard/form.css">
@endpush

@section('main-content')
<div class="main-content__panel">
    <div class="main-content__form-wrapper">
        <h3>Crear nueva subcategoría</h3>

        <form action="{{ route('subcategories.store') }}" class="form-content" method="POST" id="createForm">
            @csrf
            <x-form.select-field name="id_categoria" label="Categoría perteneciente" text="Elija una categoría"
                :options="$categorias" :currentOption="null" />
            <x-form.input-field type="text" label="Nombre" name="nombre_subcategoria"
                placeholder="Ingrese el nombre de la subcategoría" required="required" />
        </form>
        <div class="form-content__buttons">
            <button class="form-content__button form-content__button--submit" type="submit"
                form="createForm">Crear</button>
            <a href="{{ route('subcategories.index') }}"
                class="form-content__button form-content__button--back">Regresar</a>
        </div>
    </div>
</div>

@endsection