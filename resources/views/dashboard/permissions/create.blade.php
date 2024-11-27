@extends('layouts.dashboard')

@section('title', 'Crear Permiso')

@push('styles')
<link rel="stylesheet" href="/css/components/dashboard/form.css">
@endpush

@section('main-content')
<div class="main-content__panel">
    <div class="main-content__form-wrapper">
        <h3>Crear nuevo permiso</h3>
        <form action="{{ route('permissions.store') }}" class="form-content form-permisos" method="POST" id="createForm">
            @csrf
            <div class="form-column form-permisos-column inputs">
                <x-input type="text" label="Nombre del Permiso" name="nombre_permiso" placeholder="Ingrese el nombre del permiso" required />
            </div>
        </form>
        <div class="form-content__buttons">
            <button class="form-content__button form-content__button--submit" type="submit"
                form="createForm">Crear</button>
            <a href="{{ route('permissions.index') }}" class="form-content__button form-content__button--back">Regresar</a>
        </div>
    </div>
</div>
@endsection
