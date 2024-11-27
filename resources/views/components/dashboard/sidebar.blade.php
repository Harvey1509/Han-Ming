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
            ['route' => 'permissions.index', 'icon' => 'shield', 'label' => 'Permisos'],
            ['route' => 'role_permissions.index', 'icon' => 'admin_panel_settings', 'label' => 'Roles y permisos'],
        ];

        $settings = [
            ['route' => 'test', 'icon' => 'contrast', 'label' => 'Tema'],
            ['route' => 'test', 'icon' => 'language', 'label' => 'Idiomas'],
            ['route' => 'test', 'icon' => 'settings', 'label' => 'Ajustes'],
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

    <div class="sidebar__separator"></div>

    @foreach ($settings as $item)
        <a href="{{ $item['route'] }}" class="sidebar__button">
            <span class="sidebar__indicator"></span>
            <x-icon icon_name="{{ $item['icon'] }}" />
            {{ $item['label'] }}
        </a>
    @endforeach

    <div class="sidebar__separator"></div>

    <a href="#" class="sidebar__button sidebar__button--bottom">
        <span class="sidebar__indicator"></span>
        <x-icon icon_name="logout" />
        Cerrar Sesión
    </a>
</aside>