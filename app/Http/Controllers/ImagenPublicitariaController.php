<?php

namespace App\Http\Controllers;

use App\Models\ImagenPublicitaria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImagenPublicitariaController extends Controller
{

    // Funciones que devuelven vistas

    public function index()
    {
        $imagenes = ImagenPublicitaria::all();
        return view('dashboard.ad_images.index', compact('imagenes'));
    }

    public function create()
    {
        return view('dashboard.ad_images.create');
    }

    public function edit($id)
    {
        $imagen = ImagenPublicitaria::findOrFail($id);
        return view('dashboard.ad_images.edit', compact('imagen'));
    }

    // Funciones para interactuar con la base de datos

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'url_imagen' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'nullable|date|after_or_equal:fecha_inicio',
            'estado' => 'required|string|max:20',
            'tipo' => 'required|string|max:50',
            'orden' => 'nullable|integer|min:0', 
        ]);

        // Crear una nueva instancia del modelo
        $imagen = new ImagenPublicitaria();
        $imagen->fecha_inicio = $validatedData['fecha_inicio'];
        $imagen->fecha_fin = $validatedData['fecha_fin'];
        $imagen->estado = $validatedData['estado'];
        $imagen->tipo = $validatedData['tipo']; 
        $imagen->orden = $validatedData['orden'] ?? 0;
        $imagen->url_imagen = '';
        $imagen->save();

        if ($request->hasFile('url_imagen')) {
            $nombreImagen = 'imagen_' . $imagen->id;
            $imagen->url_imagen = $request->file('url_imagen')->storeAs(
                'imagenes_publicitarias',
                $nombreImagen . '.' . $request->file('url_imagen')->getClientOriginalExtension(),
                'public'
            );
            $imagen->save();
        }

        return redirect()->route('ad_images.index')->with('success', 'Imagen publicitaria creada correctamente.');
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'url_imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'nullable|date|after_or_equal:fecha_inicio',
            'estado' => 'required|string|max:20',
            'tipo' => 'required|string|max:50', 
            'orden' => 'nullable|integer|min:0',
        ]);

        $imagen = ImagenPublicitaria::findOrFail($id);
        $imagen->fecha_inicio = $validatedData['fecha_inicio'];
        $imagen->fecha_fin = $validatedData['fecha_fin'];
        $imagen->estado = $validatedData['estado'];
        $imagen->tipo = $validatedData['tipo']; 
        $imagen->orden = $validatedData['orden'] ?? 0;

        if ($request->hasFile('url_imagen')) {
            if ($imagen->url_imagen) {
                Storage::disk('public')->delete($imagen->url_imagen);
            }

            $nombreImagen = 'imagen_' . $imagen->id;
            $imagen->url_imagen = $request->file('url_imagen')->storeAs(
                'imagenes_publicitarias',
                $nombreImagen . '.' . $request->file('url_imagen')->getClientOriginalExtension(),
                'public'
            );
        }

        $imagen->save();

        return redirect()->route('ad_images.index')->with('success', 'Imagen publicitaria actualizada correctamente.');
    }


    public function destroy($id)
    {
        $imagen = ImagenPublicitaria::findOrFail($id);

        if ($imagen->url_imagen) {
            Storage::disk('public')->delete($imagen->url_imagen); // Eliminar la imagen del almacenamiento
        }

        $imagen->delete();

        return redirect()->route('ad_images.index')->with('success', 'Imagen publicitaria eliminada correctamente.');
    }
}
