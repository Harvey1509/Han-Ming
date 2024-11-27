@extends('layouts.dashboard')

@section('title', 'Usuarios')

@section('main-content')
<div class="main-content__panel">
    <x-main-content.panel-header title="Usuarios" :filters="[
        ['label' => 'Filtro por Rol'],
        ['label' => 'Estado'],
        ['label' => 'Fecha de Registro']
    ]" rowsPerPage="10" prefix="users"/>

    <x-main-content.table :headers="['Id', 'Rol', 'Nombre', 'Apellido', 'Email', 'Fecha de Registro', 'Estado', 'Acciones']">
        @foreach ($usuarios as $usuario)
            <tr>
                <td>{{ $usuario->id }}</td>
                <td>{{ $usuario->role->nombre_rol ?? 'Sin rol' }}</td>
                <td>{{ $usuario->nombre_usuario }}</td>
                <td>{{ $usuario->apellido_usuario }}</td>
                <td>{{ $usuario->email_usuario }}</td>
                <td>{{ $usuario->fecha_registro }}</td>
                <td>{{ $usuario->estado_usuario ? 'Activo' : 'Inactivo' }}</td>
                <td class="buttons">
                    <a href="{{ route('users.edit', ['id' => $usuario->id]) }}" class="buttons--edit button">Editar</a>
                    <form action="{{ route('users.destroy', ['id' => $usuario->id]) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="buttons--delete"
                            onclick="return confirm('¿Estás seguro de eliminar este usuario?');">Eliminar</button>
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
