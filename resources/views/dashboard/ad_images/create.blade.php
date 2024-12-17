@extends('layouts.dashboard')

@section('title', 'Crear Imagen Publicitaria')

@push('styles')
<link rel="stylesheet" href="/css/components/dashboard/form.css">
@endpush

@section('main-content')
<div class="main-content__panel">
    <div class="main-content__form-wrapper">
        <h3>Crear nueva imagen publicitaria</h3>
        <form action="{{ route('ad_images.store') }}" class="form-content form-imagenes" method="POST" id="createForm"
            enctype="multipart/form-data">
            @csrf
            <div class="form-column form-imagenes-column inputs">
                <x-input required name="fecha_inicio" type="date" label="Fecha de Inicio" />
                <x-input required name="fecha_fin" type="date" label="Fecha de Fin" />
                <x-select name="estado" label="Estado" text="Seleccione un estado" :options="['Activo' => 'Activo', 'Inactivo' => 'Inactivo']" :currentOption="null" />
                <x-input required name="tipo" type="text" label="Tipo" />
                <x-input required name="orden" type="text" label="Orden" />
            </div>
            <div class="form-column form-imagenes-column image">
                <x-file-upload name="url_imagen" label="Subir Imagen" />
            </div>
        </form>
        <div class="form-content__buttons">
            <button class="form-content__button form-content__button--submit" type="submit"
                form="createForm">Crear</button>
            <a href="{{ route('ad_images.index') }}" class="form-content__button form-content__button--back">Regresar</a>
        </div>
    </div>
</div>

@endsection
