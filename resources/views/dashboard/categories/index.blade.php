@extends('layouts.dashboard')

@section('title', 'Categorias')



@section('main-content')
<div class="main-content__panel">
    <x-main-content.panel-header title="Categorias" :filters="[
        ['label' => 'Filtro'],
        ['label' => 'Filtro'],
        ['label' => 'Filtro'],
        ['label' => 'Filtro']
    ]" rowsPerPage="10" prefix="categories"/>

    <x-main-content.table :headers="['Id', 'Nombre', 'Acciones']">
        @foreach ($categorias as $categoria)
            <tr>
                <td>{{ $categoria->id }}</td>
                <td>{{ $categoria->nombre_categoria }}</td>
                <td class="buttons">
                    <a href="{{ route('categories.edit', ['id' => $categoria->id]) }}"
                        class="buttons--edit button">Editar</a>
                    <form action="{{ route('categories.destroy', ['id' => $categoria->id]) }}" method="POST"
                        style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="buttons--delete"
                            onclick="return confirm('¿Estás seguro de eliminar esta categoria?');">Eliminar</button>
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