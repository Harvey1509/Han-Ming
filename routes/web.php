<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EcommerceController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\SubcategoriaController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\ImagenPublicitariaController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\RolController;
use App\Http\Controllers\PermisoController;
use App\Http\Controllers\RolPermisoController;
use App\Http\Controllers\CarritoController;

// Ruta principal redirige a la tienda pública
Route::get('/', [EcommerceController::class, 'home'])->name('shop.home');

// Rutas públicas
Route::prefix('shop')->group(function () {
    Route::get('/register', [AuthController::class, 'register'])->name('shop.register');
    Route::get('/products', [EcommerceController::class, 'products'])->name('shop.products');
    Route::get('/complaints', [EcommerceController::class, 'complaints'])->name('shop.complaints');
    Route::middleware('auth')->group(function () {
        Route::post('/complaints', [EcommerceController::class, 'sendClaim'])->name('sendClaim');
        Route::post('/carrito', [CarritoController::class, 'index'])->name('shop.carrito');
        Route::post('/carrito/agregar', [CarritoController::class, 'agregarProducto'])->name('shop.agregarProducto');
        Route::delete('/carrito/eliminar', [CarritoController::class, 'eliminarProducto'])->name('shop.eliminarProducto');
        Route::post('/carrito/finalizar', [CarritoController::class, 'finalizarCarrito'])->name('shop.finalizarCarrito');
    });
});

Route::prefix('auth')->group(function () {
    Route::get('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/register', [AuthController::class, 'handleRegister'])->name('handleRegister');
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'handleLogin'])->name('handleLogin');
});


Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Rutas del Dashboard protegidas por middleware
Route::prefix('dashboard')
    ->middleware(['auth', 'allowed_ips', 'role:Super administrador'])
    ->group(function () {

        Route::get('/', [DashboardController::class, 'dashboard'])->name('dashboard');

        // Rutas para categorías
        Route::prefix('categories')->group(function () {
            Route::get('/', [CategoriaController::class, 'index'])->name('categories.index');
            Route::get('/create', [CategoriaController::class, 'create'])->name('categories.create');
            Route::post('/create', [CategoriaController::class, 'store'])->name('categories.store');
            Route::get('/{id}', [CategoriaController::class, 'edit'])->name('categories.edit');
            Route::put('/{id}', [CategoriaController::class, 'update'])->name('categories.update');
            Route::delete('/{id}', [CategoriaController::class, 'destroy'])->name('categories.destroy');
        });

        // Rutas para subcategorías
        Route::prefix('subcategories')->group(function () {
            Route::get('/', [SubcategoriaController::class, 'index'])->name('subcategories.index');
            Route::get('/create', [SubcategoriaController::class, 'create'])->name('subcategories.create');
            Route::post('/create', [SubcategoriaController::class, 'store'])->name('subcategories.store');
            Route::get('/{id}', [SubcategoriaController::class, 'edit'])->name('subcategories.edit');
            Route::put('/{id}', [SubcategoriaController::class, 'update'])->name('subcategories.update');
            Route::delete('/{id}', [SubcategoriaController::class, 'destroy'])->name('subcategories.destroy');
        });

        // Rutas para productos
        Route::prefix('products')->group(function () {
            Route::get('/', [ProductoController::class, 'index'])->name('products.index');
            Route::get('/create', [ProductoController::class, 'create'])->name('products.create');
            Route::post('/create', [ProductoController::class, 'store'])->name('products.store');
            Route::get('/{id}', [ProductoController::class, 'edit'])->name('products.edit');
            Route::put('/{id}', [ProductoController::class, 'update'])->name('products.update');
            Route::delete('/{id}', [ProductoController::class, 'destroy'])->name('products.destroy');
        });

        // Rutas para imágenes publicitarias
        Route::prefix('ad_images')->group(function () {
            Route::get('/', [ImagenPublicitariaController::class, 'index'])->name('ad_images.index');
            Route::get('/create', [ImagenPublicitariaController::class, 'create'])->name('ad_images.create');
            Route::post('/create', [ImagenPublicitariaController::class, 'store'])->name('ad_images.store');
            Route::get('/{id}', [ImagenPublicitariaController::class, 'edit'])->name('ad_images.edit');
            Route::put('/{id}', [ImagenPublicitariaController::class, 'update'])->name('ad_images.update');
            Route::delete('/{id}', [ImagenPublicitariaController::class, 'destroy'])->name('ad_images.destroy');
        });

        // Rutas para usuarios
        Route::prefix('users')->group(function () {
            Route::get('/', [UsuarioController::class, 'index'])->name('users.index');
            Route::get('/create', [UsuarioController::class, 'create'])->name('users.create');
            Route::post('/create', [UsuarioController::class, 'store'])->name('users.store');
            Route::get('/{id}', [UsuarioController::class, 'edit'])->name('users.edit');
            Route::put('/{id}', [UsuarioController::class, 'update'])->name('users.update');
            Route::delete('/{id}', [UsuarioController::class, 'destroy'])->name('users.destroy');
        });

        // Rutas para roles
        Route::prefix('roles')->group(function () {
            Route::get('/', [RolController::class, 'index'])->name('roles.index');
            Route::get('/create', [RolController::class, 'create'])->name('roles.create');
            Route::post('/create', [RolController::class, 'store'])->name('roles.store');
            Route::get('/{id}', [RolController::class, 'edit'])->name('roles.edit');
            Route::put('/{id}', [RolController::class, 'update'])->name('roles.update');
            Route::delete('/{id}', [RolController::class, 'destroy'])->name('roles.destroy');
        });

        // Rutas para permisos
        Route::prefix('permissions')->group(function () {
            Route::get('/', [PermisoController::class, 'index'])->name('permissions.index');
            Route::get('/create', [PermisoController::class, 'create'])->name('permissions.create');
            Route::post('/create', [PermisoController::class, 'store'])->name('permissions.store');
            Route::get('/{id}', [PermisoController::class, 'edit'])->name('permissions.edit');
            Route::put('/{id}', [PermisoController::class, 'update'])->name('permissions.update');
            Route::delete('/{id}', [PermisoController::class, 'destroy'])->name('permissions.destroy');
        });

        // Rutas para permisos de roles
        Route::prefix('role_permissions')->group(function () {
            Route::get('/', [RolPermisoController::class, 'index'])->name('role_permissions.index');
            Route::get('/create', [RolPermisoController::class, 'create'])->name('role_permissions.create');
            Route::post('/create', [RolPermisoController::class, 'store'])->name('role_permissions.store');
            Route::get('/{id}', [RolPermisoController::class, 'edit'])->name('role_permissions.edit');
            Route::put('/{id}', [RolPermisoController::class, 'update'])->name('role_permissions.update');
            Route::delete('/{id}', [RolPermisoController::class, 'destroy'])->name('role_permissions.destroy');
        });
    });
