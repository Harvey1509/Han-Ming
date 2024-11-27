@extends('layouts.dashboard')

@section('title', 'Crear Rol')

@push('styles')
<link rel="stylesheet" href="/css/components/dashboard/form.css">
@endpush

@section('main-content')
<div class="main-content__panel">
    <div class="main-content__form-wrapper">
        <h3>Crear nuevo rol</h3>
        <form action="{{ route('roles.store') }}" class="form-content form-roles" method="POST" id="createForm">
            @csrf
            <div class="form-column form-roles-column inputs">
                <x-input type="text" label="Nombre del Rol" name="nombre_rol" placeholder="Ingrese el nombre del rol" required />
            </div>
        </form>
        <div class="form-content__buttons">
            <button class="form-content__button form-content__button--submit" type="submit"
                form="createForm">Crear</button>
            <a href="{{ route('roles.index') }}" class="form-content__button form-content__button--back">Regresar</a>
        </div>
    </div>
</div>
@endsection
