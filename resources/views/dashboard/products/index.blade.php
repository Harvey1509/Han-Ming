<!-- index.blade.php -->
@extends('layouts.dashboard')

@section('title', 'Productos')

@section('main-content')
<div class="main-content__panel">
    <x-main-content.panel-header title="Productos" rowsPerPageButton :rowsPerPage="$rowsPerPage" prefix="products"/>

    <x-main-content.table :headers="['Imagen', 'Codigo Producto', 'Id Subactegoria', 'Nombre', 'Descripcion', 'Precio', 'Acciones']">
        @foreach ($productos as $producto)
            <tr>
                <td class="image">
                    <img class="img-pw" src="{{ asset($producto->imagen_url_producto ? "storage/{$producto->imagen_url_producto}" : 'storage/imagen-por-defecto.png') }}">
                </td>
                <td>{{ $producto->id }}</td>
                <td>{{ $producto->id_subcategoria }}</td>
                <td>{{ $producto->nombre_producto }}</td>
                <td>{{ $producto->descripcion_producto }}</td>
                <td>S/ {{ $producto->precio_producto }}</td>
                <td class="buttons">
                    <a href="{{ route('products.edit', ['id' => $producto->id]) }}" class="buttons--edit button">Editar</a>
                    <form action="{{ route('products.destroy', ['id' => $producto->id]) }}" method="POST"
                        style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="buttons--delete"
                            onclick="return confirm('¿Estás seguro de eliminar este producto?');">Eliminar</button>
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