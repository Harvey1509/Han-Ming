@extends('layouts.dashboard')

@section('title', 'Imágenes Publicitarias')

@section('main-content')
<div class="main-content__panel">
    <x-main-content.panel-header title="Imágenes Publicitarias" rowsPerPageButton :rowsPerPage="$rowsPerPage" prefix="ad_images" />

    <x-main-content.table :headers="['Imagen', 'ID', 'Fecha Inicio', 'Fecha Fin', 'Estado', 'Tipo', 'Orden', 'Acciones']">
        @foreach ($imagenes as $imagen)
            <tr>
                <td class="image">
                    <img class="img-pw" src="{{ asset($imagen->url_imagen ? "storage/{$imagen->url_imagen}" : 'storage/imagen-por-defecto.png') }}" alt="Imagen Publicitaria" width="100">
                </td>
                <td>{{ $imagen->id }}</td>
                <td>{{ $imagen->fecha_inicio }}</td>
                <td>{{ $imagen->fecha_fin }}</td>
                <td>{{ $imagen->estado }}</td>
                <td>{{ $imagen->tipo }}</td>
                <td>{{ $imagen->orden }}</td>
                <td class="buttons">
                    <a href="{{ route('ad_images.edit', ['id' => $imagen->id]) }}" class="buttons--edit button">Editar</a>
                    <form action="{{ route('ad_images.destroy', ['id' => $imagen->id]) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="buttons--delete" onclick="return confirm('¿Estás seguro de eliminar esta imagen publicitaria?');">Eliminar</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </x-main-content.table>

    <div class="main-content__tfoot">
        <small>{{ count($imagenes) }} items</small>
        <x-main-content.pagination :pages="[1, 2, 3, '...', 1444]" :currentPage="1" />
    </div>
</div>
@endsection
