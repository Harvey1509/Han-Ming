<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiCategoriaController;
use App\Http\Controllers\ApiSubcategoriaController;
use App\Http\Controllers\ApiProductoController;

Route::group(['prefix' => 'v1'], function () {
    Route::prefix('categorias')->group(function () {
        Route::get('/', [ApiCategoriaController::class, 'index']);
        Route::get('/{id}', [ApiCategoriaController::class, 'show']);
    });
    Route::prefix('subcategorias')->group(function () {
        Route::get('/', [ApiSubcategoriaController::class, 'index']);
        Route::get('/{id}', [ApiSubcategoriaController::class, 'show']);
    });
    Route::prefix('productos')->group(function () {
        Route::get('/', [ApiProductoController::class, 'index']);
        Route::get('/{id}', [ApiProductoController::class, 'show']);
    });
});