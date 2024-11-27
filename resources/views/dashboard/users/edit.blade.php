@extends('layouts.dashboard')

@section('title', 'Editar Usuario')

@push('styles')
<link rel="stylesheet" href="/css/components/dashboard/form.css">
@endpush

@section('main-content')
<div class="main-content__panel">
    <div class="main-content__form-wrapper">
        <h3>Editar usuario</h3>
        <form action="{{ route('users.update', $usuario->id) }}" class="form-content form-users" method="POST" id="editForm">
            @method('PUT')
            @csrf
            <div class="form-column form-users-column inputs">
                <x-input type="text" label="Nombre" name="nombre_usuario" value="{{ $usuario->nombre_usuario }}" />
                <x-input type="text" label="Apellido" name="apellido_usuario" value="{{ $usuario->apellido_usuario }}" />
                <x-input type="email" label="Correo electrónico" name="email_usuario" value="{{ $usuario->email_usuario }}" />
                <x-input type="password" label="Contraseña (opcional)" name="password_usuario" placeholder="Ingrese nueva contraseña (dejar en blanco para mantener la actual)" />
                <x-form.select-field name="id_rol" label="Rol del Usuario" text="Elija un rol" :options="$roles" :currentOption="$usuario->id_rol" />
                @if($usuario->estado_usuario == 'activo')
                    <x-checkbox type="round" name="estado_usuario" checked>
                        Estado
                    </x-checkbox>
                @else
                    <x-checkbox type="round" name="estado_usuario">
                        Estado
                    </x-checkbox>
                @endif
            </div>
        </form>
        <div class="form-content__buttons">
            <button class="form-content__button form-content__button--submit" type="submit"
                form="editForm">Actualizar</button>
            <a href="{{ route('users.index') }}" class="form-content__button form-content__button--back">Regresar</a>
        </div>
    </div>
</div>
@endsection
