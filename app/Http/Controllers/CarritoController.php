<?php

namespace App\Http\Controllers;

use App\Models\Carrito;
use App\Models\CarritoProducto;
use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Orden;
use App\Mail\OrderReceivedMail;
use Illuminate\Support\Facades\Mail;

class CarritoController extends Controller
{
    // Mostrar el carrito actual del usuario
    public function index()
    {
        $carrito = Carrito::with('productos.producto')
            ->where('id_usuario', Auth::user()->id)
            ->where('estado', 'activo')
            ->first();

        if (!$carrito) {
            $carrito = Carrito::create([
                'id_usuario' => Auth::user()->id,
                'estado' => 'activo',
            ]);
        }

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
        $carrito = Carrito::where('id_usuario', Auth::user()->id)
            ->where('estado', 'activo')
            ->first();

        if (!$carrito) {
            $carrito = Carrito::create([
                'id_usuario' => Auth::user()->id,
                'estado' => 'activo',
            ]);
        }

        $producto = Producto::findOrFail($request->id_producto);

        CarritoProducto::updateOrCreate(
            ['id_carrito' => $carrito->id, 'id_producto' => $producto->id],
            ['cantidad' => $request->cantidad, 'precio_unitario' => $producto->precio_producto]
        );

        return response()->json(['success' => true]);
    }

    // Eliminar un producto del carrito
    public function eliminarProducto(Request $request)
    {

        $carritoProducto = CarritoProducto::where('id_carrito', $request->id_carrito)
            ->where('id_producto', $request->id_producto)
            ->first();

        $carritoProducto->delete();

        return response()->json(['success' => true]);
    }

    // Finalizar el carrito
    public function finalizarCarrito(Request $request)
    {
        $carrito = Carrito::where('id_usuario', Auth::user()->id)
            ->where('estado', 'activo')
            ->first();

        if (!$carrito) {
            return response()->json(['error' => 'No se encontró un carrito abierto para finalizar.'], 404);
        }

        if ($carrito->productos->isEmpty()) {
            return response()->json(['error' => 'El carrito no tiene productos.'], 400);
        }

        $carrito->update(['estado' => 'finalizado']);

        $total = $carrito->productos->sum(function ($producto) {
            return $producto->cantidad * $producto->precio_unitario;
        });

        $order = Orden::create([
            'id_usuario' => Auth::user()->id,
            'id_carrito' => $carrito->id,
            'estado' => 'pendiente',
            'total' => $total,
        ]);

        $order = Orden::with(['usuario', 'carrito.productos.producto'])->findOrFail($order->id);
        Mail::to('ovjeanbeckan@gmail.com')->send(new OrderReceivedMail($order));

        return response()->json(['message' => 'Orden enviada exitosamente.']);
    }
}
