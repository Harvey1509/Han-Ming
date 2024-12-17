<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalles de Pedido</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #FFF8EC;
            color: #333;
        }

        header {
            display: flex;
            padding: 1rem;
            background-color: #FF810B;
            color: white;
        }

        header img {
            margin-left: auto;
            margin-right: auto;
            height: 50px;
        }

        .container {
            max-width: 800px;
            margin: 2rem auto;
            background: white;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 2rem;
        }

        h1 {
            text-align: center;
            color: #FF810B;
        }

        h2 {
            color: #FF810B;
        }

        .product {
            display: flex;
            margin: 1rem 0;
            padding: 1rem;
            border-bottom: 1px solid #ddd;
        }

        .product img {
            height: 100px;
            margin-right: 1rem;
            margin-top: auto;
            margin-bottom: auto;
        }

        .total {
            text-align: right;
            font-size: 1.25rem;
            font-weight: bold;
            margin-top: 1rem;
        }
    </style>
</head>

<body>
    <header>
        <img src="{{ asset('/img/Logotipo.svg') }}" alt="Logotipo de la empresa">
    </header>
    <div class="container">
        <h1>Pedido Recibido</h1>
        <h2>Detalles del usuario</h2>
        <div>
            <p><strong>Nombre:</strong> {{ $order->usuario->nombre_usuario }}</p>
            <p><strong>Correo electrónico:</strong> {{ $order->usuario->email_usuario }}</p>
        </div>

        <h2>Detalles del pedido</h2>
        <div>
            @foreach($order->carrito->productos as $producto)
            <div class="product">
                <img src="{{ url($producto->producto->imagen_url_producto) }}" alt="{{ $producto->producto->nombre_producto }}">
                <div>
                    <h4>{{ $producto->producto->nombre_producto }}</h4>
                    <p><strong>Cantidad:</strong> {{ $producto->cantidad }}</p>
                    <p><strong>Subtotal:</strong> S/{{ $producto->cantidad * $producto->producto->precio_producto }}</p>
                </div>
            </div>
            @endforeach
        </div>

        <h3 class="total">Monto total: S/{{ $order->total }}</h3>
    </div>
</body>

</html>