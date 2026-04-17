document.addEventListener('DOMContentLoaded', function() {
    const quantityInputs = document.querySelectorAll('.cart-quantity');

    quantityInputs.forEach(input => {
        input.addEventListener('input', function() {
            const id = this.getAttribute('data-id');
            const quantity = parseInt(this.value) || 1; // Default to 1 if invalid
            const row = this.closest('tr');
            const price = parseFloat(row.getAttribute('data-price'));
            const itemTotal = price * quantity;
            document.getElementById(`cart-item-total-${id}`).textContent = `$${itemTotal.toFixed(2)}`;

            // Update grand total
            updateGrandTotal();
        });
    });

    function updateGrandTotal() {
        let grandTotal = 0;
        let totalQuantity = 0;
        const itemTotals = document.querySelectorAll('[id^="cart-item-total-"]');
        itemTotals.forEach(span => {
            const totalText = span.textContent.replace('$', '');
            grandTotal += parseFloat(totalText) || 0;
        });
        // Sum quantities
        quantityInputs.forEach(input => {
            totalQuantity += parseInt(input.value) || 0;
        });
        document.getElementById('cart-subtotal').textContent = `$${grandTotal.toFixed(2)}`;
        document.getElementById('cart-total').textContent = `$${grandTotal.toFixed(2)}`;
        // Update header
        const headerQuantity = document.getElementById('header-cart-quantity');
        if (headerQuantity) headerQuantity.textContent = totalQuantity;
        const headerTotal = document.getElementById('header-cart-total');
        if (headerTotal) headerTotal.textContent = `$${grandTotal.toFixed(2)}`;
        const offcanvasQuantity = document.getElementById('offcanvas-cart-quantity');
        if (offcanvasQuantity) offcanvasQuantity.textContent = totalQuantity;
        const offcanvasTotal = document.getElementById('offcanvas-cart-total');
        if (offcanvasTotal) offcanvasTotal.textContent = `$${grandTotal.toFixed(2)}`;
    }
});