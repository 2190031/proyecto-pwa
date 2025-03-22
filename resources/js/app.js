function updateCartCount() {
    const cart = JSON.parse(sessionStorage.getItem('cart')) || [];
    let count = cart.reduce((sum, item) => sum + item.amount, 0);
    document.getElementById('cart-count').innerText = count > 0 ? `(${count})` : "";
}

// Function to update the displayed quantity per product
function updateProductQuantityDisplay(id) {
    const cart = JSON.parse(sessionStorage.getItem('cart')) || [];
    const product = cart.find(item => item.id == id);
    const displayElement = document.querySelector(`span[data-id="${id}"]`);
    if (displayElement) {
        displayElement.innerText = product ? product.amount : 0;
    }
}

// Function to add a unit of a product to the cart
function addToCart(id, name, price) {
    let cart = JSON.parse(sessionStorage.getItem("cart")) || [];

    const product = cart.find(item => item.id == id);

    if (product) {
        product.amount += 1;
        product.total = parseFloat(product.amount * price);
    } else {
        cart.push({ id, name, amount: 1, price, total: parseFloat(price) });
    }

    sessionStorage.setItem("cart", JSON.stringify(cart));
    updateCartCount();
    updateProductQuantityDisplay(id);
}

// Function to remove a unit of a product from the cart
function removeFromCart(id) {
    let cart = JSON.parse(sessionStorage.getItem("cart")) || [];

    const productIndex = cart.findIndex(item => item.id == id);

    if (productIndex !== -1) {
        cart[productIndex].amount -= 1;

        // Remove the product if the amount reaches 0
        if (cart[productIndex].amount <= 0) {
            cart.splice(productIndex, 1);
        }

        sessionStorage.setItem("cart", JSON.stringify(cart));
    }

    updateCartCount();
    updateProductQuantityDisplay(id);
}

// Attach event listeners to Add and Remove buttons
document.querySelectorAll('[data-button="add-to-cart"]').forEach(button => {
    button.onclick = () => {
        addToCart(button.getAttribute('data-id'), button.getAttribute('data-name'), button.getAttribute('data-price'));
    }
});

document.querySelectorAll('[data-button="remove-from-cart"]').forEach(button => {
    button.onclick = () => {
        removeFromCart(button.getAttribute('data-id'));
    }
});

// Initialize cart count on page load
document.body.onload = () => {
    updateCartCount();
    document.querySelectorAll('span[data-id]').forEach(span => {
        updateProductQuantityDisplay(span.getAttribute('data-id'));
    });
};
