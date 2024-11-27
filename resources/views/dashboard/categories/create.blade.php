@extends('layouts.dashboard')

@section('title', 'Crear Categoria')

@push('styles')
<link rel="stylesheet" href="/css/components/dashboard/form.css">
@endpush


@section('main-content')
<div class="main-content__panel">
    <div class="main-content__form-wrapper">
        <h3>Crear nueva categoria</h3>

        <form action="{{ route('categories.store') }}" class="form-content" method="POST" id="createForm">
            @csrf
            <x-input type="text" label="Nombre" name="nombre_categoria" placeholder="Ingrese el nombre de la categoria" required />
        </form>
        <div class="form-content__buttons">
            <button class="form-content__button form-content__button--submit" type="submit"
                form="createForm">Crear</button>
            <a href="{{ route('categories.index') }}"
                class="form-content__button form-content__button--back">Regresar</a>
        </div>
    </div>
</div>


@endsection