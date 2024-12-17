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
    <script>
        const cartButton = document.querySelector("#shopping-cart-button");
        const cart = document.querySelector("#shopping-cart");
        const closeButton = document.querySelector("#shopping-cart-close");
        const totalElement = document.querySelector("#shopping-cart-total");
        const itemsContainer = document.querySelector("#shopping-cart-items");
        const checkoutButton = document.querySelector("#shopping-cart-checkout");
        let cartData = [];
        let updateTimeout = null;

        function updateCartTotal() {
            let total = 0;
            const items = document.querySelectorAll(".shopping-cart__item");

            items.forEach((item) => {
                const priceElement = item.querySelector(".shopping-cart__item-price");
                const quantityElement = item.querySelector(".shopping-cart__quantity-value");
                const subtotalElement = item.querySelector(".shopping-cart__item-subtotal");

                const price = parseFloat(priceElement.textContent.replace("Precio: S/", "").trim());
                const quantity = parseInt(quantityElement.textContent);

                const subtotal = price * quantity;
                subtotalElement.textContent = `Subtotal: S/${subtotal.toFixed(2)}`;
                total += subtotal;

                const itemId = item.querySelector(".shopping-cart__quantity-button--increase").getAttribute("data-id");
                localStorage.setItem(`cart-item-${itemId}`, quantity);
            });

            totalElement.textContent = `Total: S/${total.toFixed(2)}`;
        }

        async function sendQuantityUpdate(itemId, cartId, quantity) {
            try {
                const response = await fetch("{{ route('shop.actualizarCantidad') }}", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": "{{ csrf_token() }}",
                    },
                    body: JSON.stringify({
                        id: itemId,
                        id_carrito: cartId,
                        cantidad: quantity,
                    }),
                });

                const result = await response.json();

                if (!result.success) {
                    console.error("Error al actualizar la cantidad:", result.error);
                    alert("Hubo un problema al actualizar la cantidad.");
                }
            } catch (error) {
                console.error("Error al enviar la solicitud de actualización:", error);
            }
        }

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
                updateCartTotal();
            } catch (error) {
                console.error("Error al obtener el carrito:", error);
            }
        }

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

        function createCartItem(item) {
            const itemElement = document.createElement("article");
            itemElement.classList.add("shopping-cart__item");
            const savedQuantity = localStorage.getItem(`cart-item-${item.id}`) || item.cantidad;
            itemElement.innerHTML = `
            <img class="shopping-cart__item-image" src="${item.imagen}" alt="${item.nombre}">
            <div class="shopping-cart__item-details">
                <p class="shopping-cart__item-name">${item.nombre}</p>
                <p class="shopping-cart__item-price">Precio: S/${parseFloat(item.precio).toFixed(2)}</p>
                <div class="shopping-cart__item-quantity">
                    <button data-id="${item.id}" class="shopping-cart__quantity-button shopping-cart__quantity-button--decrease">-</button>
                    <span class="shopping-cart__quantity-value">${savedQuantity}</span>
                    <button data-id="${item.id}" class="shopping-cart__quantity-button shopping-cart__quantity-button--increase">+</button>
                </div>
                <p class="shopping-cart__item-subtotal">Subtotal: S/${parseFloat(item.subtotal).toFixed(2)}</p>
            </div>
            <button data-id="${item.id_producto}" data-carrito-id="${item.id_carrito}" class="shopping-cart__item-remove">
                <span class="material-symbols-outlined">delete</span>
            </button>
        `;
            return itemElement;
        }

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
                    localStorage.removeItem(`cart-item-${productId}`);
                    updateCartTotal();
                } else {
                    alert("Hubo un problema al eliminar el producto");
                }
            } catch (error) {
                console.error("Error al eliminar el producto:", error);
            }
        }

        function updateItemQuantity(button, increment) {
            const quantityElement = increment ?
                button.previousElementSibling :
                button.nextElementSibling;
            let quantity = parseInt(quantityElement.textContent);

            quantity = increment ? quantity + 1 : Math.max(quantity - 1, 1);
            quantityElement.textContent = quantity;

            const item = button.closest(".shopping-cart__item");
            const itemId = button.getAttribute("data-id");
            const cartId = item.querySelector(".shopping-cart__item-remove").getAttribute("data-carrito-id");

            updateCartTotal();

            if (updateTimeout) clearTimeout(updateTimeout);

            updateTimeout = setTimeout(() => {
                sendQuantityUpdate(itemId, cartId, quantity);
            }, 1000);
        }

        async function fetchCart() {
            try {
                const response = await fetch("{{ route('shop.carrito') }}", {
                    method: "POST",
                    headers: {
                        "X-CSRF-TOKEN": "{{ csrf_token() }}",
                    },
                });

                cartData = await response.json();
                renderCart();
                updateCartTotal();
            } catch (error) {
                console.error("Error al obtener el carrito:", error);
            }
        }

        async function finalizeCheckout() {
            try {
                const items = document.querySelectorAll(".shopping-cart__item");
                const cartItems = Array.from(items).map(item => {
                    const id = item.querySelector(".shopping-cart__quantity-button--increase").getAttribute("data-id");
                    const quantity = parseInt(item.querySelector(".shopping-cart__quantity-value").textContent);
                    return {
                        id,
                        quantity
                    };
                });

                await fetch("{{ route('shop.finalizarCarrito') }}", {
                    method: "POST",
                    headers: {
                        "X-CSRF-TOKEN": "{{ csrf_token() }}",
                        "Content-Type": "application/json"
                    },
                    body: JSON.stringify({
                        items: cartItems
                    })
                });

                alert("Pedido finalizado");
                cart.classList.remove("shopping-cart--open");
                localStorage.clear();
            } catch (error) {
                console.error("Error al finalizar el pedido:", error);
            }
        }

        itemsContainer.addEventListener("click", (e) => {
            if (e.target.closest(".shopping-cart__item-remove")) {
                const button = e.target.closest(".shopping-cart__item-remove");
                removeCartItem(button);
            }

            if (e.target.classList.contains("shopping-cart__quantity-button--increase")) {
                updateItemQuantity(e.target, true);
            }

            if (e.target.classList.contains("shopping-cart__quantity-button--decrease")) {
                updateItemQuantity(e.target, false);
            }
        });

        cartButton.addEventListener("click", () => {
            cart.classList.add("shopping-cart--open");
            fetchCart();
        });

        closeButton.addEventListener("click", () => {
            cart.classList.remove("shopping-cart--open");
        });

        checkoutButton.addEventListener("click", finalizeCheckout);

        document.addEventListener("DOMContentLoaded", updateCartTotal);
    </script>
    @endauth
</body>

</html>