const quantInput = document.getElementById('quantInput');

if(quantInput != null) {
    quantInput.addEventListener('input', (event) => {
        const value = document.getElementById('priceTag').innerHTML;
        const cleanString = value.replace(/[^0-9]/g, ""); 
        var result = BigInt(cleanString);

        result = result * BigInt(quantInput.value);
        const idrFormatter = new Intl.NumberFormat('id-ID', {
            style: 'currency',
            currency: 'IDR',
        });
        document.getElementById('SubtotalCalc').innerHTML = "Subtotal: " + idrFormatter.format(result);
    });
}