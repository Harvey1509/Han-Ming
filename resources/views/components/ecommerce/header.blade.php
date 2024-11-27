<header class="header">
    <div class="header__top">
        <div class="header__container container">
            <button class="header__m-icon">
                <span class="material-symbols-outlined"> menu </span>
            </button>
            <a href="home.html" class="header__logo">
                <img alt="Logotipo" class="logotipo logotipo--header" />
            </a>
            <button class="header__m-icon inactive">
                <span class="material-symbols-outlined"> shopping_cart </span>
            </button>
            <x-search
            class="header__search-box"
            icon_left
            placeholder="Busqueda de palabras clave" />
            <nav>
                <ul class="header__actions">
                    <li>
                        <a href="../auth/register.html" class="active">
                            <span class="material-symbols-outlined"> edit </span>
                            <span>Regístrate</span>
                        </a>
                    </li>
                    <li>
                        <a href="../auth/login.html">
                            <span class="material-symbols-outlined"> person </span>
                            <span>Iniciar Sesión</span>
                        </a>
                    </li>
                    <li class="header__separator inactive"></li>
                    <li class="inactive">
                        <a href="#" class="inactive">
                            <span class="material-symbols-outlined"> shopping_cart </span>
                            <span>$0.00</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>

    <div class="header__bottom">
        <div class="header__container container">
            <nav>
                <ul class="header__menu">
                    <li>
                        <a href="home.html">
                            <span class="material-symbols-outlined"> home </span>
                            <span>Inicio</span>
                        </a>
                    </li>
                    <li>
                        <a href="products.html">
                            <span class="material-symbols-outlined"> store </span>
                            <span>Productos</span>
                        </a>
                    </li>
                    <li>
                        <a href="complaints.html">
                            <span class="material-symbols-outlined"> menu_book </span>
                            <span>Libro de reclamaciones</span>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <span class="material-symbols-outlined"> build </span>
                            <span>Servicio Técnico</span>
                            <span class="material-symbols-outlined"> arrow_drop_down </span>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</header>