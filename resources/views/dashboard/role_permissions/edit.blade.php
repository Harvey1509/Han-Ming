@extends('layouts.dashboard')

@section('title', 'Editar Relación Rol-Permiso')

@push('styles')
<link rel="stylesheet" href="/css/components/dashboard/form.css">
@endpush

@section('main-content')
<div class="main-content__panel">
    <div class="main-content__form-wrapper">
        <h3>Editar relación</h3>
        <form action="{{ route('role_permissions.update', $rolPermiso->id) }}" class="form-content form-role-permissions" method="POST" id="editForm">
            @method('PUT')
            @csrf
            <div class="form-column form-role-permissions-column inputs">
                <x-form.select-field name="id_rol" label="Rol" text="Seleccione un rol" :options="$roles" :currentOption="$rolPermiso->id_rol" />
                <x-form.select-field name="id_permiso" label="Permiso" text="Seleccione un permiso" :options="$permisos" :currentOption="$rolPermiso->id_permiso" />
            </div>
        </form>
        <div class="form-content__buttons">
            <button class="form-content__button form-content__button--submit" type="submit" form="editForm">Actualizar</button>
            <a href="{{ route('role_permissions.index') }}" class="form-content__button form-content__button--back">Regresar</a>
        </div>
    </div>
</div>
@endsection
