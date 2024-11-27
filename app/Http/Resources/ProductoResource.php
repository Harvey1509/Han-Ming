<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductoResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'subcategoria' => $this->id_subcategoria,
            'nombre' => $this->nombre_producto,
            'descripcion' => $this->descripcion_producto,
            'precio' => $this->precio_producto,
            'imagen' => url('storage/' . $this->imagen_url_producto),
        ];
    }
}
