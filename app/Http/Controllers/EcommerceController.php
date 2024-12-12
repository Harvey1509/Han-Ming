<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendClaimMail;
use Illuminate\Support\Facades\Auth;
use App\Models\Categoria;
use App\Models\Producto;
use App\Models\ImagenPublicitaria;
use App\Models\Orden;
use App\Mail\OrderReceivedMail;

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
            // Datos del proveedor
            'razon_social' => 'required|string|max:255',
            'ruc' => 'required|string|max:11',
            'tienda' => 'required|string|max:255',
            'direccion' => 'required|string|max:255',
            'numeracion_impreso' => 'required|string|max:255',
            'fecha' => 'required|date',

            // Datos del consumidor
            'nombres_apellidos' => 'required|string|max:255',
            'dni' => 'required|string|max:8',
            'domicilio' => 'required|string|max:255',
            'distrito' => 'required|string|max:255',
            'telefono' => 'nullable|string|max:255',
            'email' => 'required|email',
            
            // Solo en caso de ser menor de edad
            'nombre_representante' => 'nullable|string|max:255',
            'dni_representante' => 'nullable|string|max:8',
            'email_representante' => 'nullable|email',
            'telefono_representante' => 'nullable|string|max:255',

            // Identificacion del bien contratado
            'producto_servicio' => 'required|string|max:255',
            'descripcion' => 'required|string|max:255',
            'monto_reclamado' => 'required|numeric',

            // Detalle de la reclamacion y pedido del consumidor
            'reclamo' => 'required|string|max:255',
            'pedido_consumidor' => 'required|string|max:255',
        ]);

        // Agregar el correo del usuario logueado
        $complaintData = $validated;
        $complaintData['email'] = Auth::user()->email_usuario; 

        // Enviar el correo
        Mail::to('ovjeanbeckan@gmail.com')->send(new SendClaimMail($complaintData));

        // Redirigir con mensaje de éxito
        return redirect()->back()->with('success', 'Reclamación enviada correctamente.');
    }

    public function sendOrderEmail($orderId)
    {
        $order = Orden::with(['usuario', 'carrito.productos.producto'])->findOrFail($orderId);

        // Enviar correo
        Mail::to($order->usuario->email_usuario)->send(new OrderReceivedMail($order));

        return response()->json(['message' => 'Orden enviado exitosamente.']);
    }
}
