document.getElementById('increment').addEventListener('click', function () {
    const quantityInput = document.getElementById('add_to_cart_quantity');
    quantityInput.value = parseInt(quantityInput.value) + 1;
});

document.getElementById('decrement').addEventListener('click', function () {
    const quantityInput = document.getElementById('add_to_cart_quantity');
    quantityInput.value = parseInt(quantityInput.value) - 1;
});