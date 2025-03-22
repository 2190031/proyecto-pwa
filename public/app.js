
function addToCart(id, name) {
    const cart =
        sessionStorage.getItem("cart") || sessionStorage.setItem("cart", "{}");

    const product = {
        id: id,
        name: name,
        amount: 1,
    };

    sessionStorage.setItem("cart", cart);
}
