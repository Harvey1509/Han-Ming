<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendClaimMail;
use Illuminate\Support\Facades\Auth;
use App\Models\Categoria;
use App\Models\Producto;
use App\Models\ImagenPublicitaria;

class EcommerceController extends Controller
{
    public function home()
    {
        $imagenes_slider = ImagenPublicitaria::where('tipo', 'paginaInicio')
            ->where('estado', 'activo')
            ->orderBy('orden', 'asc')
            ->get(['url_imagen']);
        $imagenes_slider->each(function ($imagen) {
            $imagen->url_imagen = url('storage/' . $imagen->url_imagen);
        });
        return view('ecommerce.home', compact('imagenes_slider'));
    }

    public function products()
    {
        $categorias = Categoria::whereHas('subcategorias.productos') 
            ->with(['subcategorias' => function ($query) {
                $query->whereHas('productos'); 
            }])
            ->get();

        $imagenes_slider = ImagenPublicitaria::where('tipo', 'paginaProductos')->get(['url_imagen']);
        $imagenes_slider->each(function ($imagen) {
            $imagen->url_imagen = url('storage/' . $imagen->url_imagen);
        });

        $productos = Producto::paginate(15);

        return view('ecommerce.products', compact('productos', 'categorias', 'imagenes_slider'));
    }



    public function complaints()
    {
        return view('ecommerce.complaints');
    }

    public function sendClaim(Request $request)
    {
        // Validar los datos del formulario
        $validated = $request->validate([
            'razon_social' => 'required|string|max:255',
            'ruc' => 'required|string|max:11',
            'tienda' => 'required|string|max:255',
            'direccion' => 'required|string|max:255',
            'fecha' => 'required|date',
            'nombres_apellidos' => 'required|string|max:255',
            'dni' => 'required|string|max:8',
            'email' => 'required|email',
            'reclamo' => 'required|string',
            'pedido_consumidor' => 'required|string',
            'monto_reclamado' => 'required|numeric',
        ]);

        // Agregar el correo del usuario logueado
        $complaintData = $validated;
        $complaintData['email'] = Auth::user()->email_usuario; 

        // Enviar el correo
        Mail::to('ovjeanbeckan@gmail.com')->send(new SendClaimMail($complaintData));

        // Redirigir con mensaje de éxito
        return redirect()->back()->with('success', 'Reclamación enviada correctamente.');
    }
}
