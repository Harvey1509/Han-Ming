@extends('layouts.ecommerce')

@section('title', 'Registrate')

@push('styles')
    <link rel="stylesheet" href="/css/auth/register.css">
@endpush

@section('content')
<section class="register">
    <div class="register__container container">
        <form class="register__form" method="post" action="{{ route('handleRegister') }}">
            @csrf
            <h1 class="register__title">Estamos maravillados de recibirlo en nuestra página..</h1>
            <div class="register__input-box">
                <x-input required id="name" type="text" name="name" placeholder="Nombre" />
                <x-input required id="lastname" type="text" name="lastname" placeholder="Apellido" />
                <x-input required id="email" type="email" name="email" placeholder="Correo eléctronico" />
                <x-input required id="password" type="password" name="password" placeholder="Contraseña" />
                <x-input required id="password_confirmation" type="password" name="password_confirmation" placeholder="Confirmar contraseña" />
            </div>
            <div class="register__buttons">
                <button type="submit" class="register__button">Registrarse</button>
                <a href="{{route('login')}}" class="register__login">¿Ya tienes una cuenta?</a>
            </div>
        </form>

        <div class="register__intro">
            <img src="/img/Register-img.png" alt="registerimagen" class="register__image">
        </div>
    </div>
</section>
@endsection