@extends('layouts.ecommerce')

@section('title', 'Libro de reclamaciones')

@push('styles')
    <link rel="stylesheet" href="/css/components/ecommerce/pages/complaints.css">
@endpush

@section('content')
<form class="form container" id="reclamacionesForm" method="POST" action="{{ route('sendClaim') }}">
    @csrf
    <h1>Libro de Reclamaciones</h1>

    <section class="form__section">
        <h2 class="form__title">Datos del proveedor</h2>
        <x-input label="Razon Social" id="razon_social" type="text" name="razon_social" placeholder="Ingrese su email" required/>
        <x-input label="RUC" id="ruc" type="text" name="ruc" placeholder="Ingrese su RUC (11 digitos)" required/>
        <x-input label="Tienda" id="tienda" type="text" name="tienda" placeholder="Ingrese el nombre de la tienda" required/>
        <x-input label="Direccion" id="direccion" type="text" name="direccion" placeholder="Ingrese la direccion" required/>
        <x-input label="Numeracion impreso" id="numeracion_impreso" type="text" name="numeracion_impreso" placeholder="Ingrese la numeracion del impreso" required/>
        <x-input label="Fecha" id="fecha" type="date" name="fecha" required/>
    </section>

    <section class="form__section">
        <h2 class="form__title">Datos del consumidor</h2>
        <x-input label="Nombres y Apellidos" id="nombres_apellidos" type="text" name="nombres_apellidos" placeholder="Ingrese sus nombres y apellidos" required/>
        <x-input label="DNI" id="dni" type="text" name="dni" placeholder="Ingrese su DNI (8 dígitos)" required/>
        <x-input label="Domicilio" id="domicilio" type="text" name="domicilio" placeholder="Ingrese su domicilio" required/>
        <x-input label="Distrito" id="distrito" type="text" name="distrito" placeholder="Ingrese su distrito" required/>
        <x-input label="Telefono (Opcional)" id="telefono" type="tel" name="telefono" placeholder="Ingrese su teléfono (9 dígitos)"/>
        <x-input label="Correo electrónico" id="email" type="email" name="email" placeholder="Ingrese su correo electrónico" required/>
    </section>

    <section class="form__section">
        <h2 class="form__title">Solo completar en caso de ser menor de edad</h2>
        <x-input label="Nombre y apellidos del padre, madre o representante" id="nombre_representante" type="text" name="nombre_representante" placeholder="Ingrese el nombre del representante"/>
        <x-input label="DNI del padre, madre o representante" id="dni_representante" type="text" name="dni_representante" placeholder="Ingrese el DNI del representante"/>
        <x-input label="Correo electrónico del padre, madre o representante" id="email_representante" type="email" name="email_representante" placeholder="Ingrese el correo electrónico del representante"/>
        <x-input label="Teléfono del padre, madre o representante" id="telefono_representante" type="tel" name="telefono_representante" placeholder="Ingrese el teléfono del representante"/>
    </section>

    <section class="form__section">
        <h2 class="form__title">Identificación del bien contratado</h2>
        <x-input label="Producto / Servicio" id="producto_servicio" type="text" name="producto_servicio" placeholder="Ingrese el nombre del producto o servicio" required/>
        <x-textarea label="Descripción" id="descripcion" name="descripcion" placeholder="Describa el producto o servicio" required/>
        <x-input label="Monto reclamado" id="monto_reclamado" type="number" name="monto_reclamado" placeholder="Ingrese el monto a reclamar" required/>
    </section>

    <section class="form__section">
        <h2 class="form__title">Detalle de la reclamación y pedido del consumidor</h2>
        <x-textarea label="Reclamo" id="reclamo" name="reclamo" placeholder="Escriba su reclamo aquí" required/>
        <x-textarea label="Pedido del consumidor" id="pedido_consumidor" name="pedido_consumidor" placeholder="Escriba su pedido aquí" required/>
    </section>

    <section class="form__section">
        <x-checkbox type="square" id="terminos" name="terminos" >
            He leído los <a href="#"><strong>términos y condiciones.</strong></a>
        </x-checkbox>
        <x-checkbox type="square" id="privacidad" name="privacidad" >
            Declaro haber leído las <a href="#"><strong>políticas de privacidad</strong></a> y autorizo el tratamiento de mis datos conforme a ella.
        </x-checkbox>
        <x-checkbox type="square" id="promocionales" name="promocionales" >
            Acepto el uso de mis datos personales para fines promocionales.
        </x-checkbox>
    </section>

    <div class="form__button-wrapper">
        <button class="form__button primary-button" type="submit" id="sendButton">Enviar</button>
    </div>
</form>
@endsection