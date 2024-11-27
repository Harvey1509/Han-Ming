@extends('layouts.dashboard')

@section('title', 'Editar Permiso')

@push('styles')
<link rel="stylesheet" href="/css/components/dashboard/form.css">
@endpush

@section('main-content')
<div class="main-content__panel">
    <div class="main-content__form-wrapper">
        <h3>Editar permiso</h3>
        <form action="{{ route('permissions.update', $permiso->id) }}" class="form-content form-permisos" method="POST" id="editForm">
            @method('PUT')
            @csrf
            <div class="form-column form-permisos-column inputs">
                <x-input type="text" label="Nombre del Permiso" name="nombre_permiso" value="{{ $permiso->nombre_permiso }}" required />
            </div>
        </form>
        <div class="form-content__buttons">
            <button class="form-content__button form-content__button--submit" type="submit"
                form="editForm">Actualizar</button>
            <a href="{{ route('permissions.index') }}" class="form-content__button form-content__button--back">Regresar</a>
        </div>
    </div>
</div>
@endsection
