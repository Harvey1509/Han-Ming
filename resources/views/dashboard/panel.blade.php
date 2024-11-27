@extends('layouts.dashboard')

@section('title', 'Dashboard')

@section('content')
<h1>Hola mundo desde el dashboard.blade.php</h1>
<x-input
    status="error"
    label="Correo Electrónico"
    placeholder="Ingrese su email"
    r_text="Debe ser un correo válido." />

<x-search
    status="disabled"
    icon_left
    placeholder="Buscar productos..." />

<x-toggle
    label="Enable Notifications"
    checked
    disabled />




<x-accordion title="Acordeón Abierto" open="true">
    <p>Este es el contenido del acordeón abierto.</p>
    <button>Botón de Acción</button>
</x-accordion>


@endsection