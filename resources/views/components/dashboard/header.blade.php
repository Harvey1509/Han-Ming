<header class="header">
    <img src="{{ asset('img/Logotipo.svg') }}" alt="Logotipo" class="logotipo">

    <div class="header__user">
        <div class="header__desc">
            <h4>{{ Auth::user()->nombre_usuario }}</h4>
        </div>
    </div>
</header>