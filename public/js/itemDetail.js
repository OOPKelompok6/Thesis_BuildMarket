const value = document.getElementById('priceTag').innerHTML;
const cleanString = value.replace(/[^0-9]/g, ""); 
const price = BigInt(cleanString);;
const quantInput = document.getElementById('quantInput');
const subtotalCalc = document.getElementById('subtotalCalc');
const decrementBtn = document.getElementById('decrementBtn');
const incrementBtn = document.getElementById('incrementBtn');

function formatRupiah(number) {
    return 'Rp ' + number.toLocaleString('id-ID');
}

function updateSubtotal() {
    const qty = parseInt(quantInput.value) || 1;
    subtotalCalc.textContent = 'Sub Total: ' + formatRupiah(price * BigInt(qty));
}

if (quantInput) {
    quantInput.addEventListener('input', updateSubtotal);

    decrementBtn.addEventListener('click', function () {
        if (parseInt(quantInput.value) > 1) {
            quantInput.value = parseInt(quantInput.value) - 1;
            updateSubtotal();
        }
    });

    incrementBtn.addEventListener('click', function () {
        if (parseInt(quantInput.value) < parseInt(quantInput.max)) {
            quantInput.value = parseInt(quantInput.value) + 1;
            updateSubtotal();
        }
    });
}