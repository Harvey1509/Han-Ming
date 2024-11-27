@extends('layouts.dashboard')

@section('title', 'Roles y Permisos')

@section('main-content')
<div class="main-content__panel">
    <x-main-content.panel-header title="Roles y Permisos" :filters="[
        ['label' => 'FIltro 1'],
        ['label' => 'Filtro 2'],
        ['label' => 'Filtro 3']
        ]" rowsPerPage="10" prefix="role_permissions" />

    <x-main-content.table :headers="['Id', 'Rol', 'Permiso', 'Acciones']">
        @foreach ($rolesPermisos as $rolPermiso)
            <tr>
                <td>{{ $rolPermiso->id }}</td>
                <td>{{ $rolPermiso->rol->nombre_rol }}</td>
                <td>{{ $rolPermiso->permiso->nombre_permiso }}</td>
                <td class="buttons">
                    <a href="{{ route('role_permissions.edit', ['id' => $rolPermiso->id]) }}" class="buttons--edit button">Editar</a>
                    <form action="{{ route('role_permissions.destroy', ['id' => $rolPermiso->id]) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="buttons--delete" onclick="return confirm('¿Estás seguro de eliminar esta relación?');">
                            Eliminar
                        </button>
                    </form>
                </td>
            </tr>
        @endforeach
    </x-main-content.table>
    <div class="main-content__tfoot">
        <small>1 - 10 of {{ $rolesPermisos->count() }} items</small>
        <x-main-content.pagination :pages="[1, 2, 3, '...', 5]" :currentPage="1" />
    </div>
</div>
@endsection
