<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        @yield('title', 'Dashboard') | Han Ming
    </title>

    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />

    <link rel="stylesheet" href="/css/reset.css">
    <link rel="stylesheet" href="/css/global.css">
    <link rel="stylesheet" href="/css/components/ecommerce/header.css">
    <link rel="stylesheet" href="/css/components/ecommerce/footer.css">
    <link rel="stylesheet" href="/css/components/ecommerce/cart.css">

    <link rel="shortcut icon" href="/img/Logo.png" type="image/x-icon">

    @stack('styles')
</head>

<body>
    <x-ecommerce.header />
    <main class="main">
        @yield('content')
    </main>
    <x-ecommerce.footer />

    @stack('scripts')

    @auth
    <!-- Scripts solo si esta autenticado el usuario -->
    <!-- Script para el carrito de compras -->
    <script>
        // ---- Variables Globales ----
        const cartButton = document.querySelector("#shopping-cart-button");
        const cart = document.querySelector("#shopping-cart");
        const closeButton = document.querySelector("#shopping-cart-close");
        const totalElement = document.querySelector("#shopping-cart-total");
        const itemsContainer = document.querySelector("#shopping-cart-items");
        const checkoutButton = document.querySelector("#shopping-cart-checkout");
        let cartData = [];

        // ---- Funciones Principales ----

        // Actualizar los totales del carrito
        function updateCartTotal() {
            let total = 0;
            const items = document.querySelectorAll(".shopping-cart__item");

            items.forEach((item) => {
                const priceElement = item.querySelector(".shopping-cart__item-price");
                const quantityElement = item.querySelector(
                    ".shopping-cart__quantity-value"
                );
                const subtotalElement = item.querySelector(
                    ".shopping-cart__item-subtotal"
                );

                const price = parseFloat(
                    priceElement.textContent.replace("Precio: S/", "").trim()
                );
                const quantity = parseInt(quantityElement.textContent);

                const subtotal = price * quantity;
                subtotalElement.textContent = `Subtotal: S/${subtotal.toFixed(2)}`;
                total += subtotal;
            });

            totalElement.textContent = `Total: S/${total.toFixed(2)}`;
        }

        // Obtener el carrito desde el backend
        async function fetchCart() {
            try {
                const response = await fetch("{{ route('shop.carrito') }}", {
                    method: "POST",
                    headers: {
                        "X-CSRF-TOKEN": "{{ csrf_token() }}"
                    },
                });

                cartData = await response.json();
                renderCart();
            } catch (error) {
                console.error("Error al obtener el carrito:", error);
            }
        }

        // Renderizar el carrito en el DOM
        function renderCart() {
            itemsContainer.innerHTML = "";
            let total = 0;

            cartData.forEach((item) => {
                const itemElement = createCartItem(item);
                itemsContainer.appendChild(itemElement);
                total += parseFloat(item.subtotal);
            });

            totalElement.textContent = `Total: S/${total.toFixed(2)}`;
        }

        // Crear un elemento de producto del carrito
        function createCartItem(item) {
            const itemElement = document.createElement("article");
            itemElement.classList.add("shopping-cart__item");
            itemElement.innerHTML = `
            <img class="shopping-cart__item-image" src="${item.imagen}" alt="${
        item.nombre
    }">
            <div class="shopping-cart__item-details">
                <p class="shopping-cart__item-name">${item.nombre}</p>
                <p class="shopping-cart__item-price">Precio: S/${parseFloat(
                    item.precio
                ).toFixed(2)}</p>
                <div class="shopping-cart__item-quantity">
                    <button data-id="${
                        item.id
                    }" class="shopping-cart__quantity-button shopping-cart__quantity-button--decrease">-</button>
                    <span class="shopping-cart__quantity-value">${
                        item.cantidad
                    }</span>
                    <button data-id="${
                        item.id
                    }" class="shopping-cart__quantity-button shopping-cart__quantity-button--increase">+</button>
                </div>
                <p class="shopping-cart__item-subtotal">Subtotal: S/${parseFloat(
                    item.subtotal
                ).toFixed(2)}</p>
            </div>
            <button data-id="${item.id}" data-carrito-id="${
        item.id_carrito
    }" class="shopping-cart__item-remove">
                <span class="material-symbols-outlined">delete</span>
            </button>
        `;
            return itemElement;
        }

        // Eliminar un producto del carrito
        async function removeCartItem(button) {
            const productId = button.getAttribute("data-id");
            const cartId = button.getAttribute("data-carrito-id");

            try {
                const response = await fetch("{{ route('shop.eliminarProducto') }}", {
                    method: "DELETE",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": "{{ csrf_token() }}",
                    },
                    body: JSON.stringify({
                        id_producto: productId,
                        id_carrito: cartId,
                    }),
                });

                const data = await response.json();

                if (data.success) {
                    button.closest(".shopping-cart__item").remove();
                    updateCartTotal();
                } else {
                    alert("Hubo un problema al eliminar el producto");
                }
            } catch (error) {
                console.error("Error al eliminar el producto:", error);
            }
        }

        // Actualizar la cantidad de un producto
        function updateItemQuantity(button, increment) {
            const quantityElement = increment ?
                button.previousElementSibling :
                button.nextElementSibling;
            let quantity = parseInt(quantityElement.textContent);

            quantity = increment ? quantity + 1 : Math.max(quantity - 1, 1);
            quantityElement.textContent = quantity;

            updateCartTotal();
        }

        // Finalizar pedido
        async function finalizeCheckout() {
            try {
                await fetch("{{ route('shop.finalizarCarrito') }}", {
                    method: "POST",
                    headers: {
                        "X-CSRF-TOKEN": "{{ csrf_token() }}"
                    },
                });
                alert("Pedido finalizado");
                cart.classList.remove("shopping-cart--open");
            } catch (error) {
                console.error("Error al finalizar el pedido:", error);
            }
        }

        // ---- Manejo de Eventos ----

        // Delegación de eventos en el carrito
        itemsContainer.addEventListener("click", (e) => {
            if (e.target.closest(".shopping-cart__item-remove")) {
                const button = e.target.closest(".shopping-cart__item-remove");
                removeCartItem(button);
            }

            if (
                e.target.classList.contains("shopping-cart__quantity-button--increase")
            ) {
                updateItemQuantity(e.target, true);
            }

            if (
                e.target.classList.contains("shopping-cart__quantity-button--decrease")
            ) {
                updateItemQuantity(e.target, false);
            }
        });

        // Abrir y cerrar el carrito
        cartButton.addEventListener("click", () => {
            cart.classList.add("shopping-cart--open");
            fetchCart();
        });

        closeButton.addEventListener("click", () => {
            cart.classList.remove("shopping-cart--open");
        });

        // Finalizar pedido
        checkoutButton.addEventListener("click", finalizeCheckout);
    </script>
    @endauth
</body>

</html>