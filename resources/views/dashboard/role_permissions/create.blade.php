@extends('layouts.dashboard')

@section('title', 'Crear Relación Rol-Permiso')

@push('styles')
<link rel="stylesheet" href="/css/components/dashboard/form.css">
@endpush

@section('main-content')
<div class="main-content__panel">
    <div class="main-content__form-wrapper">
        <h3>Crear nueva relación</h3>
        <form action="{{ route('role_permissions.store') }}" class="form-content form-role-permissions" method="POST" id="createForm">
            @csrf
            <div class="form-column form-role-permissions-column inputs">
                <x-form.select-field name="id_rol" label="Rol" text="Seleccione un rol" :options="$roles" :currentOption="null" />
                <x-form.select-field name="id_permiso" label="Permiso" text="Seleccione un permiso" :options="$permisos" :currentOption="null" />
            </div>
        </form>
        <div class="form-content__buttons">
            <button class="form-content__button form-content__button--submit" type="submit" form="createForm">Crear</button>
            <a href="{{ route('role_permissions.index') }}" class="form-content__button form-content__button--back">Regresar</a>
        </div>
    </div>
</div>
@endsection
