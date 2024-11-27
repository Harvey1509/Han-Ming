@extends('layouts.dashboard')

@section('title', 'Permisos')

@section('main-content')
<div class="main-content__panel">
    <x-main-content.panel-header title="Permisos" :filters="[
        ['label' => 'Buscar por Nombre']
    ]" rowsPerPage="10" prefix="permissions"/>

    <x-main-content.table :headers="['Id', 'Nombre del Permiso', 'Acciones']">
        @foreach ($permisos as $permiso)
            <tr>
                <td>{{ $permiso->id }}</td>
                <td>{{ $permiso->nombre_permiso }}</td>
                <td class="buttons">
                    <a href="{{ route('permissions.edit', ['id' => $permiso->id]) }}" class="buttons--edit button">Editar</a>
                    <form action="{{ route('permissions.destroy', ['id' => $permiso->id]) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="buttons--delete"
                            onclick="return confirm('¿Estás seguro de eliminar este permiso?');">Eliminar</button>
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
