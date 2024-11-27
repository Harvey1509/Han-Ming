<?php

namespace App\Http\Controllers;

use App\Models\ImagenPublicitaria;
use App\Http\Resources\ImagenPublicitariaCollection;
use App\Http\Resources\ImagenPublicitariaResource;
use Illuminate\Http\Request;

class ApiImagenPublicitariaController extends Controller
{
    public function index(Request $request)
    {
        // Aquí puedes implementar filtros si es necesario
        $imagenesPublicitarias = ImagenPublicitaria::paginate()->appends($request->query());
        return new ImagenPublicitariaCollection($imagenesPublicitarias);
    }

    public function show(ImagenPublicitaria $imagenPublicitaria)
    {
        return new ImagenPublicitariaResource($imagenPublicitaria);
    }
}
