@extends('layouts.dashboard')

@section('title', 'Subcategorias')

@section('main-content')
<div class="main-content__panel">
    <x-main-content.panel-header title="Subcategorias" rowsPerPageButton :rowsPerPage="$rowsPerPage" prefix="subcategories"/>

    <x-main-content.table :headers="['Id', 'Id Categoria', 'Nombre', 'Acciones']">
        @forelse ($subcategorias as $subcategoria)
            <tr>
                <td>{{ $subcategoria->id }}</td>
                <td>{{ $subcategoria->id_categoria }}</td>
                <td>{{ $subcategoria->nombre_subcategoria }}</td>
                <td class="buttons">
                    <a href="{{ route('subcategories.edit', ['id' => $subcategoria->id]) }}"
                        class="buttons--edit button">Editar</a>
                    <form action="{{ route('subcategories.destroy', ['id' => $subcategoria->id]) }}" method="POST"
                        style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="buttons--delete"
                            onclick="return confirm('¿Estás seguro de eliminar esta subcategoría?');">Eliminar</button>
                    </form>
                </td>
            </tr>
            @empty
        <tr>
            <td colspan="3">No se encontraron resultados para "{{ $search }}".</td>
        </tr>
        @endforelse
    </x-main-content.table>

    <div class="main-content__tfoot">
        <small>1 - 100 of 138 items</small>
        <x-main-content.pagination :pages="[1, 2, 3, '...', 1444]" :currentPage="1" />
    </div>
</div>

@endsection