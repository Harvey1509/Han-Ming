@extends('layouts.dashboard')

@section('title', 'Crear Usuario')

@push('styles')
<link rel="stylesheet" href="/css/components/dashboard/form.css">
@endpush

@section('main-content')
<div class="main-content__panel">
    <div class="main-content__form-wrapper">
        <h3>Crear nuevo usuario</h3>
        <form action="{{ route('users.store') }}" class="form-content form-users" method="POST" id="createForm">
            @csrf
            <div class="form-column form-users-column inputs">
                <x-input type="text" label="Nombre" name="nombre_usuario" placeholder="Ingrese el nombre del usuario" required />
                <x-input type="text" label="Apellido" name="apellido_usuario" placeholder="Ingrese el apellido del usuario" required />
                <x-input type="email" label="Correo electrónico" name="email_usuario" placeholder="Ingrese el email" required />
                <x-input type="password" label="Contraseña" name="password_usuario" placeholder="Ingrese la contraseña" required />
                <x-form.select-field name="id_rol" label="Rol del Usuario" text="Elija un rol" :options="$roles" :currentOption="null" />
                <x-checkbox type="round" name="estado_usuario" checked>
                    Estado (Activo por defecto)
                </x-checkbox>
            </div>
        </form>
        <div class="form-content__buttons">
            <button class="form-content__button form-content__button--submit" type="submit"
                form="createForm">Crear</button>
            <a href="{{ route('users.index') }}" class="form-content__button form-content__button--back">Regresar</a>
        </div>
    </div>
</div>
@endsection
