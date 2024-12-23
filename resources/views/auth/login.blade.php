<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicia Sesión | Han Ming</title>

    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />

    <link rel="stylesheet" href="/css/reset.css">
    <link rel="stylesheet" href="/css/global.css">

    <link rel="stylesheet" href="/css/auth/login.css">

    <link rel="shortcut icon" href="/img/Logo.png" type="image/x-icon">
</head>

<body>
    <header class="header">
        <div class="header__top">
            <div class="header__container container" style="justify-content: center;">
                <a href="{{route('shop.home')}}" class="header__logo">
                    <img alt="Logotipo" class="logotipo logotipo--header" />
                </a>
            </div>
        </div>
    </header>

    <section class="main">

        <section class="login">
            <div class="login__container container">
                <div class="login__intro">
                    <img src="/img/Login-img.png" alt="loginimagen" class="login__image">
                </div>

                <form class="login__form" method="post" action="{{ route('handleLogin') }}">
                    @csrf
                    <h2 class="login__title">Bienvenido, por favor inicie sesión con sus datos.</h2>
                    <div class="login__input-box">
                        <x-input id="email" type="email" name="email" placeholder="Correo eléctronico" />
                        <x-input id="password" type="password" name="password" placeholder="Contraseña" />
                    </div>
                    <div class="login__utils">
                    <x-toggle label="Recordar mis datos"/>
                        <a href="#" class="login__forgot">¿Olvidaste tu contraseña?</a>
                    </div>
                    <div class="login__buttons">
                        <button type="submit" class="login__button">Acceder</button>
                        <a href="{{route('register')}}" class="login__register">Registrarse</a>
                    </div>
                </form>
            </div>
        </section>

    </section>

    <footer class="footer">
        <div class="footer__bottom">
            <div class="footer__container container">
                <p class="footer__copyright"> © 2024 <strong>HAN MING️ S.A.C</strong> - Todos los derechos reservados.
                </p>
            </div>
        </div>
    </footer>
</body>

</html>