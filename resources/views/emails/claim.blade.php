<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reclamación Recibida</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            background-color: #f9f9f9;
            color: #333;
            margin: 0;
            padding: 20px;
        }
        .container {
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            padding: 20px;
            max-width: 600px;
            margin: 20px auto;
        }
        h2 {
            color: #0056b3;
            border-bottom: 2px solid #e5e5e5;
            padding-bottom: 5px;
            margin-top: 20px;
        }
        p {
            margin: 10px 0;
        }
        strong {
            color: #444;
        }
        .highlight {
            font-size: 1.1em;
            color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Datos del Proveedor:</h2>
        <p><strong class="highlight">Razón Social:</strong> {{ $complaintData['razon_social'] }}</p>
        <p><strong class="highlight">RUC:</strong> {{ $complaintData['ruc'] }}</p>
        <p><strong class="highlight">Tienda:</strong> {{ $complaintData['tienda'] }}</p>
        <p><strong class="highlight">Dirección:</strong> {{ $complaintData['direccion'] }}</p>
        <p><strong class="highlight">Fecha:</strong> {{ $complaintData['fecha'] }}</p>

        <h2>Datos del Consumidor:</h2>
        <p><strong class="highlight">Nombre:</strong> {{ $complaintData['nombres_apellidos'] }}</p>
        <p><strong class="highlight">DNI:</strong> {{ $complaintData['dni'] }}</p>
        <p><strong class="highlight">Correo electrónico:</strong> {{ $complaintData['email'] }}</p>

        <h2>Reclamo:</h2>
        <p>{{ $complaintData['reclamo'] }}</p>

        <h2>Pedido del Consumidor:</h2>
        <p>{{ $complaintData['pedido_consumidor'] }}</p>

        <p><strong class="highlight">Monto Reclamo:</strong> S/{{ $complaintData['monto_reclamado'] }}</p>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", () => {
        const productosRenderizar = document.getElementById("productos__renderizar");
        const buttonsCategory = document.querySelectorAll(".category-button, .subcategory-button, .price-filter-button");
        const searchInput = document.getElementById("nombre");

        // Escucha clicks en botones de categorías o precios
        buttonsCategory.forEach(button => {
            button.addEventListener("click", () => {
                const filtro = button.dataset.subcategoryId ?
                    {
                        subcategoria: button.dataset.subcategoryId
                    } :
                    button.dataset.price ?
                    parsePriceFilter(button.dataset.price) :
                    {};
                fetchProductos(filtro);
            });
        });

        // Escucha el input para buscar por nombre
        searchInput.addEventListener("input", () => {
            const filtro = {
                nombre: `%${searchInput.value}%`
            };
            fetchProductos(filtro);
        });

        // Convierte el filtro de precio (ej. lt-10) a un formato de consulta
        const parsePriceFilter = (priceFilter) => {
            if (priceFilter.startsWith("lt")) return {
                precio: {
                    lt: 10
                }
            };
            if (priceFilter.startsWith("gt")) return {
                precio: {
                    gt: 50
                }
            };
            if (priceFilter.includes("-")) {
                const [min, max] = priceFilter.split("-");
                return {
                    precio: {
                        gte: parseInt(min),
                        lte: parseInt(max)
                    }
                };
            }
            return {};
        };

        // Función para realizar el fetch de productos
        const fetchProductos = async (filtros = {}) => {
            try {
                const query = new URLSearchParams();
                for (const key in filtros) {
                    if (typeof filtros[key] === "object") {
                        for (const operator in filtros[key]) {
                            query.append(`${key}[${operator}]`, filtros[key][operator]);
                        }
                    } else {
                        query.append(`${key}[like]`, filtros[key]);
                    }
                }
                const response = await fetch(`/api/v1/productos?${query.toString()}`);
                const data = await response.json();
                renderProductos(data.data);
            } catch (error) {
                console.error("Error al obtener los productos:", error);
            }
        };

        // Función para renderizar productos en el DOM
        const renderProductos = (productos) => {
            productosRenderizar.innerHTML = productos
                .map(producto => `
                <div class="productos__imagen">
                    <img src="${producto.imagen || '/img/producto.png'}" alt="${producto.nombre}">
                    <div class="producto__detalles">
                        <p class="producto__nombre">${producto.nombre}</p>
                        <h4 class="producto__precio">$${producto.precio}</h4>
                        <button class="producto__carrito">Agregar al Carrito</button>
                    </div>
                </div>
            `)
                .join("");
        };
    });
    </script>
</body>
</html>
