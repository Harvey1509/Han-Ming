@extends('layouts.dashboard')

@section('title', 'Editar Categoria')

@push('styles')
<link rel="stylesheet" href="/css/components/dashboard/form.css">
@endpush


@section('main-content')
<div class="main-content__panel">
    <div class="main-content__form-wrapper">
        <h3>Editar categoria</h3>

        <form action="{{ route('categories.update', $categoria->id) }}" class="form-content" method="POST" id="editForm">
            @method('PUT')
            @csrf
            <x-input type="text" label="Id" value="{{ $categoria->id }}" status="disabled" />
            <x-input type="text" label="Nombre" name="nombre_categoria" value="{{ $categoria->nombre_categoria }}" />
        </form>
        <div class="form-content__buttons">
            <button class="form-content__button form-content__button--submit" type="submit"
                form="editForm">Actualizar</button>
            <a href="{{ route('categories.index') }}"
                class="form-content__button form-content__button--back">Regresar</a>
        </div>
    </div>
</div>


@endsection