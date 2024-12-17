<aside class="sidebar">
    @php
        $routes = [
            ['route' => 'dashboard', 'icon' => 'dashboard', 'label' => 'Dashboard'],
            ['route' => 'categories.index', 'icon' => 'category', 'label' => 'Categorias'],
            ['route' => 'subcategories.index', 'icon' => 'shoppingmode', 'label' => 'Subcategorias'],
            ['route' => 'products.index', 'icon' => 'inventory_2', 'label' => 'Productos'],
            ['route' => 'ad_images.index', 'icon' => 'image', 'label' => 'Imagenes Publicitarias'],
            ['route' => 'users.index', 'icon' => 'person', 'label' => 'Usuarios'],
            ['route' => 'roles.index', 'icon' => 'manage_accounts', 'label' => 'Roles'],
        ];
    @endphp

    @foreach ($routes as $item)
        <a href="{{ route($item['route']) }}"
            class="sidebar__button {{ request()->routeIs($item['route']) ? 'sidebar__button--active' : '' }}">
            <span class="sidebar__indicator"></span>
            <x-icon icon_name="{{ $item['icon'] }}" />
            {{ $item['label'] }}
        </a>
    @endforeach
    <form action="{{route('logout')}}" method="post" class="sidebar__logout">
        @csrf
        <button type="submit" class="sidebar__button sidebar__button--bottom">
            <span class="sidebar__indicator"></span>
            <x-icon icon_name="logout" />
            Cerrar Sesión
        </button>
    </form>
</aside>