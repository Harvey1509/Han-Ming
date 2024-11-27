<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Subcategoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductoController extends Controller
{

    // Funciones que devuelven vistas

    public function index()
    {
        $productos = Producto::with('subcategoria')->get();
        return view('dashboard.products.index', compact('productos'));
    }

    public function create()
    {
        $subcategorias = Subcategoria::pluck('nombre_subcategoria', 'id')->toArray();
        return view('dashboard.products.create', compact('subcategorias'));
    }

    
    public function edit($id)
    {
        $producto = Producto::findOrFail($id);
        $subcategorias = Subcategoria::pluck('nombre_subcategoria', 'id')->toArray();
        $subcategoria_asociada = $producto->subcategoria;
        return view('dashboard.products.edit', compact('producto', 'subcategorias', 'subcategoria_asociada'));
    }

    // Funciones que interactúan con la base de datos

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nombre_producto' => 'nullable|string|max:255',
            'subcategoria_producto' => 'required|exists:subcategorias,id',
            'precio_producto' => 'nullable|numeric',
            'descripcion_producto' => 'nullable|string',
            'imagen_producto' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $producto = new Producto();
        $producto->nombre_producto = $validatedData['nombre_producto'];
        $producto->id_subcategoria = $validatedData['subcategoria_producto'];
        $producto->precio_producto = $validatedData['precio_producto'];
        $producto->descripcion_producto = $validatedData['descripcion_producto'];
        $producto->imagen_url_producto = '';
        $producto->save();

        // Guardar la imagen asociada al producto
        if ($request->hasFile('imagen_producto')) {
            $nombreProducto = str_replace(' ', '_', $validatedData['nombre_producto']);
            $nombreImagen = $producto->id . '_' . $nombreProducto; // Solo ID y nombre_producto

            $producto->imagen_url_producto = $request->file('imagen_producto')->storeAs(
                'imagenes_productos',
                $nombreImagen . '.' . $request->file('imagen_producto')->getClientOriginalExtension(),
                'public'
            );

            $producto->save();
        }

        return redirect()->route('products.index')->with('success', 'Producto creado correctamente.');
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'nombre_producto' => 'nullable|string|max:255',
            'subcategoria_producto' => 'required|exists:subcategorias,id',
            'precio_producto' => 'nullable|numeric',
            'descripcion_producto' => 'nullable|string',
            'imagen_producto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $producto = Producto::findOrFail($id);
        $nombreProductoAnterior = $producto->nombre_producto;
        $producto->nombre_producto = $validatedData['nombre_producto'];
        $producto->id_subcategoria = $validatedData['subcategoria_producto'];
        $producto->precio_producto = $validatedData['precio_producto'];
        $producto->descripcion_producto = $validatedData['descripcion_producto'];

        if ($request->hasFile('imagen_producto')) {
            if ($producto->imagen_url_producto) {
                Storage::disk('public')->delete($producto->imagen_url_producto);
            }

            $nombreProducto = str_replace(' ', '_', $validatedData['nombre_producto']);
            $nombreImagen = $producto->id . '_' . $nombreProducto; // Solo ID y nombre_producto

            $producto->imagen_url_producto = $request->file('imagen_producto')->storeAs(
                'imagenes_productos',
                $nombreImagen . '.' . $request->file('imagen_producto')->getClientOriginalExtension(),
                'public'
            );
        } else {
            if ($nombreProductoAnterior !== $validatedData['nombre_producto'] && $producto->imagen_url_producto) {
                $nombreProducto = str_replace(' ', '_', $validatedData['nombre_producto']);
                $extension = pathinfo($producto->imagen_url_producto, PATHINFO_EXTENSION);
                $nuevoNombreImagen = 'imagenes_productos/' . $producto->id . '_' . $nombreProducto . '.' . $extension;

                Storage::disk('public')->move($producto->imagen_url_producto, $nuevoNombreImagen);

                $producto->imagen_url_producto = $nuevoNombreImagen;
            }
        }

        $producto->save();

        return redirect()->route('products.index')->with('success', 'Producto actualizado correctamente.');
    }

    public function destroy($id)
    {
        $producto = Producto::findOrFail($id);

        if ($producto->imagen_url_producto) {
            Storage::disk('public')->delete($producto->imagen_url_producto);
        }

        $producto->delete();

        return redirect()->route('products.index')->with('success', 'Producto eliminado correctamente.');
    }

}
