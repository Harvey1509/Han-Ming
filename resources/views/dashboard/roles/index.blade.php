@extends('layouts.dashboard')

@section('title', 'Roles')

@section('main-content')
<div class="main-content__panel">
    <x-main-content.panel-header title="Roles" :filters="[
        ['label' => 'Buscar por Nombre']
    ]" rowsPerPage="10" prefix="roles"/>

    <x-main-content.table :headers="['Id', 'Nombre del Rol', 'Acciones']">
        @foreach ($roles as $rol)
            <tr>
                <td>{{ $rol->id }}</td>
                <td>{{ $rol->nombre_rol }}</td>
                <td class="buttons">
                    <a href="{{ route('roles.edit', ['id' => $rol->id]) }}" class="buttons--edit button">Editar</a>
                    <form action="{{ route('roles.destroy', ['id' => $rol->id]) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="buttons--delete"
                            onclick="return confirm('¿Estás seguro de eliminar este rol?');">Eliminar</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </x-main-content.table>
    <div class="main-content__tfoot">
        <small>1 - 100 of 138 items</small>
        <x-main-content.pagination :pages="[1, 2, 3, '...', 1444]" :currentPage="1" />
    </div>
</div>
@endsection
