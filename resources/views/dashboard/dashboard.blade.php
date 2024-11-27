@extends('layouts.dashboard')

@section('title', 'Dashboard')

@push('styles')
    <link rel="stylesheet" href="/css/components/dashboard/dashboard.css">
@endpush

@section('main-content')
    <div class="main-content__cards">
        <a href="{{ route('categories.index') }}" class="main-content__card">
            <x-icon icon_name="category" />
            <h4>Categorias</h4>
        </a>
        <a href="{{ route('subcategories.index') }}" class="main-content__card">
            <x-icon icon_name="shoppingmode" />
            <h4>Subcategorias</h4>
        </a>
        <a href="{{ route('products.index') }}" class="main-content__card">
            <x-icon icon_name="inventory_2" />
            <h4>Productos</h4>
        </a>
    </div>
@endsection

