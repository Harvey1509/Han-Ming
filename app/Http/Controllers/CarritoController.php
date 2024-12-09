<?php

namespace App\Http\Controllers;

use App\Models\Carrito;
use App\Models\CarritoProducto;
use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class CarritoController extends Controller
{
    // Mostrar el carrito actual del usuario
    public function index()
    {
        Log::info('Usuario autenticado: ', ['id' => Auth::user()->id]);

        $carrito = Carrito::with('productos.producto')
            ->where('id_usuario', Auth::user()->id)
            ->where('estado', 'activo')
            ->first();

        if (!$carrito) {
            Log::info('Carrito no encontrado, creando uno nuevo.');
            $carrito = Carrito::create([
                'id_usuario' => Auth::user()->id,
                'estado' => 'activo',
            ]);
        }

        Log::info('Carrito encontrado o creado: ', ['carrito_id' => $carrito->id]);

        return response()->json($carrito->productos->map(function ($item) {
            return [
                'id_carrito' => $item->id_carrito,
                'id' => $item->id,
                'imagen' => url('storage/' . $item->producto->imagen_url_producto),
                'nombre' => $item->producto->nombre_producto,
                'precio' => $item->precio_unitario,
                'cantidad' => $item->cantidad,
                'subtotal' => $item->cantidad * $item->precio_unitario,
            ];
        }));
    }

    // Agregar un producto al carrito
    public function agregarProducto(Request $request)
    {
        Log::info('Agregar producto al carrito', [
            'id_producto' => $request->id_producto,
            'cantidad' => $request->cantidad,
        ]);

        $carrito = Carrito::where('id_usuario', Auth::user()->id)
            ->where('estado', 'activo')
            ->first();

        if (!$carrito) {
            Log::info('Carrito no encontrado, creando uno nuevo.');
            $carrito = Carrito::create([
                'id_usuario' => Auth::user()->id,
                'estado' => 'activo',
            ]);
        }

        $producto = Producto::findOrFail($request->id_producto);
        Log::info('Producto encontrado: ', ['id' => $producto->id, 'nombre' => $producto->nombre_producto]);

        CarritoProducto::updateOrCreate(
            ['id_carrito' => $carrito->id, 'id_producto' => $producto->id],
            ['cantidad' => $request->cantidad, 'precio_unitario' => $producto->precio_producto]
        );

        Log::info('Producto agregado/actualizado en el carrito', [
            'id_carrito' => $carrito->id,
            'id_producto' => $producto->id,
            'cantidad' => $request->cantidad,
        ]);

        return response()->json(['success' => true]);
    }

    // Eliminar un producto del carrito
    public function eliminarProducto(Request $request)
    {
        Log::info('Eliminar producto del carrito', [
            'id_carrito' => $request->id_carrito,
            'id_producto' => $request->id_producto,
        ]);

        $carritoProducto = CarritoProducto::where('id_carrito', $request->id_carrito)
            ->where('id_producto', $request->id_producto)
            ->first();

        if ($carritoProducto) {
            Log::info('Producto encontrado, eliminando.', ['id' => $carritoProducto->id]);
            $carritoProducto->delete();
        } else {
            Log::warning('Producto no encontrado en el carrito.');
        }

        return response()->json(['success' => true]);
    }

    // Finalizar el carrito
    public function finalizarCarrito(Request $request)
    {
        Log::info('Finalizar carrito para el usuario: ', ['id_usuario' => Auth::user()->id]);

        $carrito = Carrito::where('id_usuario', Auth::user()->id)
            ->where('estado', 'activo')
            ->first();

        if ($carrito) {
            Log::info('Carrito encontrado, finalizando.', ['id_carrito' => $carrito->id]);
            $carrito->update(['estado' => 'finalizado']);
        } else {
            Log::warning('No se encontró un carrito abierto para finalizar.');
        }

        return response()->json(['success' => true]);
    }
}
