@extends('layouts.dashboard')

@section('title', 'Editar Rol')

@push('styles')
<link rel="stylesheet" href="/css/components/dashboard/form.css">
@endpush

@section('main-content')
<div class="main-content__panel">
    <div class="main-content__form-wrapper">
        <h3>Editar rol</h3>
        <form action="{{ route('roles.update', $rol->id) }}" class="form-content form-roles" method="POST" id="editForm">
            @method('PUT')
            @csrf
            <div class="form-column form-roles-column inputs">
                <x-input type="text" label="Nombre del Rol" name="nombre_rol" value="{{ $rol->nombre_rol }}" required />
            </div>
        </form>
        <div class="form-content__buttons">
            <button class="form-content__button form-content__button--submit" type="submit"
                form="editForm">Actualizar</button>
            <a href="{{ route('roles.index') }}" class="form-content__button form-content__button--back">Regresar</a>
        </div>
    </div>
</div>
@endsection
