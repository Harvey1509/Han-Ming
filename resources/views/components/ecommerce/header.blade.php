<header class="header">
    <div class="header__top">
        <div class="header__container container">
            <button class="header__m-icon">
                <span class="material-symbols-outlined"> menu </span>
            </button>
            <a href="{{route('shop.home')}}" class="header__logo">
                <img alt="Logotipo" class="logotipo logotipo--header" />
            </a>
            <button class="header__m-icon inactive">
                <span class="material-symbols-outlined"> shopping_cart </span>
            </button>
            <nav>
                <ul class="header__actions">
                    @auth
                    <li>
                        <h4>{{ Auth::user()->nombre_usuario }}</h4>
                        <form action="{{route('logout')}}" method="post">
                            @csrf
                            <button type="submit">Cerrar sesión</button>
                        </form>
                    </li>
                    <li class="header__separator"></li>
                    <li>
                        <button id="shopping-cart-button" class="shopping-cart-button">
                            <span class="material-symbols-outlined">shopping_cart</span>
                        </button>
                    </li>
                    @else
                    <li>
                        <a href="{{route('register')}}" class="active">
                            <span class="material-symbols-outlined"> edit </span>
                            <span>Regístrate</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{route('login')}}">
                            <span class="material-symbols-outlined"> person </span>
                            <span>Iniciar Sesión</span>
                        </a>
                    </li>
                    <li class="header__separator inactive"></li>
                    <li class="inactive">
                        <button id="shopping-cart-button" class="shopping-cart-button inactive">
                            <span class="material-symbols-outlined">shopping_cart</span>
                        </button>
                    </li>
                    @endauth
                    @auth
                    @include('components.ecommerce.cart')
                    @endauth
                </ul>
            </nav>
        </div>
    </div>

    <div class="header__bottom">
        <div class="header__container container">
            <nav>
                <ul class="header__menu">
                    <li>
                        <a href="{{route('shop.home')}}">
                            <span class="material-symbols-outlined"> home </span>
                            <span>Inicio</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{route('shop.products')}}">
                            <span class="material-symbols-outlined"> store </span>
                            <span>Productos</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{route('shop.complaints')}}">
                            <span class="material-symbols-outlined"> menu_book </span>
                            <span>Libro de reclamaciones</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</header>