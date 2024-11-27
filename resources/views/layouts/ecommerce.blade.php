<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        @yield('title', 'Dashboard') | Han Ming
    </title>

    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0"/>

    <link rel="stylesheet" href="/css/reset.css">
    <link rel="stylesheet" href="/css/global.css">
    <link rel="stylesheet" href="/css/components/ecommerce/header.css">
    <link rel="stylesheet" href="/css/components/ecommerce/footer.css">

    <link rel="shortcut icon" href="/img/Logo.png" type="image/x-icon">

    @stack('styles')
</head>

<body>
    <x-ecommerce.header />
    <main class="main">
        @yield('content')
    </main>
    <x-ecommerce.footer />
</body>

</html>