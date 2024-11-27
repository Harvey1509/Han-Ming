@extends('layouts.dashboard')

@section('title', 'Editar Imagen Publicitaria')

@push('styles')
<link rel="stylesheet" href="/css/components/dashboard/form.css">
@endpush

@section('main-content')

<div class="main-content__panel">
    <div class="main-content__form-wrapper">
        <h3>Editar Imagen Publicitaria</h3>

        <form action="{{ route('ad_images.update', $imagen->id) }}" class="form-content form-imagenes" method="POST"
            id="editForm" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-column form-imagenes-column inputs">
                <x-form.input-field type="text" label="ID" value="{{ $imagen->id }}" status="disabled" />
                <x-form.input-field name="fecha_inicio" type="date" label="Fecha de Inicio" value="{{ $imagen->fecha_inicio }}" />
                <x-form.input-field name="fecha_fin" type="date" label="Fecha de Fin" value="{{ $imagen->fecha_fin }}" />
                <x-form.input-field name="tipo" type="text" label="Tipo" value="{{ $imagen->tipo }}" />
                <x-form.input-field name="orden" type="text" label="Orden" value="{{ $imagen->orden }}" />
                <x-form.select-field name="estado" label="Estado" text="Seleccione un estado" :options="['Activo' => 'Activo', 'Inactivo' => 'Inactivo']" :currentOption="$imagen->estado" />
            </div>
            <div class="form-column form-imagenes-column image">
                <x-form.file-upload name="url_imagen" label="Cambiar Imagen" :src="$imagen->url_imagen" />
            </div>
        </form>
        <div class="form-content__buttons">
            <button class="form-content__button form-content__button--submit" type="submit"
                form="editForm">Actualizar</button>
            <a href="{{ route('ad_images.index') }}" class="form-content__button form-content__button--back">Regresar</a>
        </div>
    </div>
</div>


@endsection
