@extends('layouts.dashboard')

@section('title', 'Editar Subcategoría')

@push('styles')
<link rel="stylesheet" href="/css/components/dashboard/form.css">
@endpush


@section('main-content')
<div class="main-content__panel">
    <div class="main-content__form-wrapper">
        <h3>Editar Subcategoría</h3>
        <form action="{{ route('subcategories.update', $subcategoria->id) }}" class="form-content" method="POST"
            id="editForm">
            @method('PUT')
            @csrf
            <x-form.input-field type="text" label="Id" value="{{ $subcategoria->id }}" status="disabled" />
            <x-form.input-field name="nombre_subcategoria" type="text" label="Nombre actual"
                value="{{ $subcategoria->nombre_subcategoria }}" required="required" />
            <x-form.select-field label="Subcategoría perteneciente" name="categoria_perteneciente"
                text="Elija una subcategoría" :options="$categorias" :currentOption="$categoria_asociada->id" />
        </form>
        <div class="form-content__buttons">
            <button class="form-content__button form-content__button--submit" type="submit"
                form="editForm">Actualizar</button>
            <a href="{{ route('subcategories.index') }}"
                class="form-content__button form-content__button--back">Regresar</a>
        </div>
    </div>
</div>


@endsection