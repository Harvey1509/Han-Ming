<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reclamación Recibida</title>
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
            max-width: 900px;
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
            margin-top: 1.5rem;
        }

        p {
            margin: 0.5rem 0;
        }

        .highlight {
            font-weight: bold;
        }
    </style>
</head>

<body>
    <header>
        <img src="{{ asset('/img/Logotipo.svg') }}" alt="Logotipo de la empresa">
    </header>
    <div class="container">
        <h1>Reclamación Recibida</h1>
        <h2>Datos del Proveedor:</h2>
        <p><span class="highlight">Razón Social:</span> {{ $complaintData['razon_social'] }}</p>
        <p><span class="highlight">RUC:</span> {{ $complaintData['ruc'] }}</p>
        <p><span class="highlight">Tienda:</span> {{ $complaintData['tienda'] }}</p>
        <p><span class="highlight">Dirección:</span> {{ $complaintData['direccion'] }}</p>
        <p><span class="highlight">Numeración Impreso:</span> {{ $complaintData['numeracion_impreso'] }}</p>
        <p><span class="highlight">Fecha:</span> {{ $complaintData['fecha'] }}</p>

        <h2>Datos del Consumidor:</h2>
        <p><span class="highlight">Nombre:</span> {{ $complaintData['nombres_apellidos'] }}</p>
        <p><span class="highlight">DNI:</span> {{ $complaintData['dni'] }}</p>
        <p><span class="highlight">Domicilio:</span> {{ $complaintData['domicilio'] }}</p>
        <p><span class="highlight">Distrito:</span> {{ $complaintData['distrito'] }}</p>
        <p><span class="highlight">Teléfono:</span> {{ $complaintData['telefono'] }}</p>
        <p><span class="highlight">Correo Electrónico:</span> {{ $complaintData['email'] }}</p>

        @if(isset($complaintData['nombre_representante']) && isset($complaintData['dni_representante']) && isset($complaintData['email_representante']) && isset($complaintData['telefono_representante']))
            <h2>Solo en caso de menor de edad:</h2>
            <p><span class="highlight">Nombre del Representante:</span> {{ $complaintData['nombre_representante'] }}</p>
            <p><span class="highlight">DNI del Representante:</span> {{ $complaintData['dni_representante'] }}</p>
            <p><span class="highlight">Correo del Representante:</span> {{ $complaintData['email_representante'] }}</p>
            <p><span class="highlight">Teléfono del Representante:</span> {{ $complaintData['telefono_representante'] }}</p>
        @endif

        <h2>Identificación del Bien Contratado:</h2>
        <p><span class="highlight">Producto/Servicio:</span> {{ $complaintData['producto_servicio'] }}</p>
        <p><span class="highlight">Descripción:</span> {{ $complaintData['descripcion'] }}</p>
        <p><span class="highlight">Monto Reclamado:</span> S/{{ $complaintData['monto_reclamado'] }}</p>

        <h2>Detalle de la Reclamación:</h2>
        <p>{{ $complaintData['reclamo'] }}</p>

        <h2>Pedido del Consumidor:</h2>
        <p>{{ $complaintData['pedido_consumidor'] }}</p>
    </div>
</body>


</html>