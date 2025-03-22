@extends('layouts.base')

@section('content')
    <div class="w-full">
        <div class="flex flex-row justify-between">
            <h1 class="text-2xl font-black">Shopping Cart</h1>
            <button onclick="emptyCart()"
                class="ms-auto me-4 hover:bg-white hover:text-[#0A0A0A] hover:outline outline-white transition cursor-pointer text-white rounded-lg flex flex-row gap-2 items-center p-2">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="m9.75 9.75 4.5 4.5m0-4.5-4.5 4.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                </svg>

                <span class="font-black">Empty cart</span>
            </button>
            <button onclick="submitOrder()"
                class="bg-white hover:bg-transparent hover:text-white hover:outline outline-white transition cursor-pointer text-[#0a0a0a] rounded-lg flex flex-row gap-2 items-center p-2">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M15.75 10.5V6a3.75 3.75 0 1 0-7.5 0v4.5m11.356-1.993 1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 0 1-1.12-1.243l1.264-12A1.125 1.125 0 0 1 5.513 7.5h12.974c.576 0 1.059.435 1.119 1.007ZM8.625 10.5a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm7.5 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                </svg>

                <span class="font-black">Make order</span>
            </button>
        </div>

        <table class="w-full mt-3 table-auto">
            <thead>
                <tr class="*:text-start">
                    <th></th>
                    <th class="w-12">ID</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody id="cart">
                <tr>
                    <td colspan="6" class="text-center">Loading cart...</td>
                </tr>
            </tbody>
        </table>
        <a class="bg-white mt-6 hover:bg-transparent hover:text-white hover:outline outline-white w-fit transition cursor-pointer text-[#0a0a0a] rounded-lg flex flex-row gap-2 items-center p-2"
            href="{{ route('products.index') }}">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M8.25 9V5.25A2.25 2.25 0 0 1 10.5 3h6a2.25 2.25 0 0 1 2.25 2.25v13.5A2.25 2.25 0 0 1 16.5 21h-6a2.25 2.25 0 0 1-2.25-2.25V15M12 9l3 3m0 0-3 3m3-3H2.25" />
            </svg>
            Go to catalogue
        </a>
    </div>

    <script>
        function updateCartCount() {
            const cart = JSON.parse(sessionStorage.getItem('cart'));
            let count = 0;
            cart.forEach(item => count += item.amount)
            document.getElementById('cart-count').innerText = count > 0 ? `(${count})` : "";
        }

        function emptyCart() {
            sessionStorage.removeItem("cart");
            alert("Cart emptied successfully.");
            updateCartCount();
            window.location.reload();
        }

        function submitOrder() {
            const cart = JSON.parse(sessionStorage.getItem("cart")) || [];
            if (cart.length === 0) {
                alert("Your cart is empty.");
                return;
            }

            fetch("{{ route('orders.store') }}", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": "{{ csrf_token() }}"
                    },
                    body: JSON.stringify({
                        date: new Date().toISOString().split('T')[0],
                        cart: cart
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        sessionStorage.removeItem("cart");
                        alert("Order placed successfully.");
                        window.location.reload();
                    } else {
                        alert("Error placing order.");
                    }
                })
                .catch(error => console.error("Error:", error));
        }

        function renderCart() {
            const cart = JSON.parse(sessionStorage.getItem("cart")) || [];
            const cartTable = document.getElementById("cart");

            if (!cartTable) return;

            cartTable.innerHTML = ""; // Clear previous content

            if (cart.length === 0) {
                cartTable.innerHTML = `<tr><td colspan="5" class="text-center">Cart is empty</td></tr>`;
                return;
            }

            cart.forEach((product, index) => {
                const row = document.createElement("tr");
                row.className = "transition hover:bg-white/5";

                row.innerHTML = `
            <td>
                <button onclick="removeFromCart(${index})" class="p-1 text-red-500 transition-all bg-transparent cursor-pointer hover:text-red-700">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                    </svg>

                </button>
            </td>
            <td class="w-12">${product.id}</td>
            <td>${product.name}</td>
            <td>$${product.price}</td>
            <td>${product.amount}</td>
            <td>$${product.total}</td>
        `;

                cartTable.appendChild(row);
            });
        }

        // Remove item from cart
        function removeFromCart(index) {
            let cart = JSON.parse(sessionStorage.getItem("cart")) || [];
            cart.splice(index, 1);
            sessionStorage.setItem("cart", JSON.stringify(cart));
            renderCart(); // Re-render the cart
            updateCartCount();
        }

        // Call this function when the page loads
        document.addEventListener("DOMContentLoaded", renderCart);
    </script>
@endsection
