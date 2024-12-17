<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        @yield('title', 'Dashboard') | Han Ming
    </title>
    <link rel="shortcut icon" href="{{ asset('img/Logo.ico') }}" type="image/x-icon">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <link rel="stylesheet" href="/css/reset.css">
    <link rel="stylesheet" href="/css/global.css">
    <link rel="stylesheet" href="/css/components/dashboard/sidebar.css">
    <link rel="stylesheet" href="/css/components/dashboard/main-content.css">
    <link rel="stylesheet" href="/css/layouts/dashboard.css">
    @stack('styles')
</head>

<body>
    <x-dashboard.header />

    <div class="dashboard-container">
        <x-dashboard.sidebar />
        <section class="main-content">
            <div class="main-content__wrapper">
                @yield('main-content')
                <x-dashboard.modal-message />
            </div>
        </section>
    </div>

    <x-preview-img />

    @stack('scripts')

    
    <script>
        function handleSearch(event) {
            const query = event.target.value;
            const url = new URL(window.location.href);
            url.searchParams.set('search', query);
            window.history.replaceState(null, '', url); 

            clearTimeout(window.searchTimeout);
            window.searchTimeout = setTimeout(() => {
                window.location.href = url;
            }, 500);
        }
    </script>

</body>

</html>