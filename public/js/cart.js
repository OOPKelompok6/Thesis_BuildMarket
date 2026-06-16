var uploadCollection;
var deleteCollection;

document.addEventListener("DOMContentLoaded", () => {
    uploadCollection = document.querySelectorAll('.upd-btn');
    deleteCollection = document.querySelectorAll('.dlt-btn');

    configureShipmentButtons();

    uploadCollection.forEach(updBtn => {
        updBtn.addEventListener('click', function() {
            
            let updId = updBtn.id;
            updId = updId.replace(/\D/g, ""); 
            
            let inpElement = document.getElementById(`quantInput-${updId}`);
            let updateForm = document.getElementById('updateForm');
            let updateInput = document.getElementById('updateFinInput');
            let sbmtBtn = document.getElementById('sbmtBtn');

            updateInput.setAttribute('max', inpElement.getAttribute('max'));
            updateInput.value = inpElement.value;
            updateForm.setAttribute('action', `cart/${updId}`);
            sbmtBtn.setAttribute('form', `updateForm`);

            sbmtBtn.setAttribute('class', `btn btn-primary`);
            sbmtBtn.innerHTML = 'Update';

            let headerText = document.getElementById(`deleteModalLabel`);
            let contentText = document.getElementById('modalContent'); 

            headerText.innerHTML = 'Confirm Update';
            contentText.innerHTML = 'Are you sure you want to update this item?';

            if (!inpElement.checkValidity()) {
                inpElement.reportValidity();
                return;
            }
        });
    });

    deleteCollection.forEach(dltBtn => {
        dltBtn.addEventListener('click', function() {
            let dltId = dltBtn.id;
            dltId = dltId.replace(/\D/g, ""); 
            
            let deleteForm = document.getElementById('deleteForm');
            let sbmtBtn = document.getElementById('sbmtBtn');

            deleteForm.setAttribute('action', `cart/${dltId}`);
            sbmtBtn.setAttribute('form', `deleteForm`);

            sbmtBtn.setAttribute('class', `btn btn-danger`);
            sbmtBtn.innerHTML = 'Delete';

            let headerText = document.getElementById(`deleteModalLabel`);
            let contentText = document.getElementById('modalContent'); 

            headerText.innerHTML = 'Confirm Deletion';
            contentText.innerHTML = 'Are you sure you want to delete this item?';
        });
    });

    document.getElementById(`checkoutBtn`).addEventListener('click', function() {
        
        let sbmtBtn = document.getElementById('sbmtBtn');

        sbmtBtn.setAttribute('form', `cartForm`);
        document.getElementById('cartForm').setAttribute('action', `/completeTransaction`);

        sbmtBtn.setAttribute('class', `btn btn-primary`);
        sbmtBtn.innerHTML = 'Submit';

        let headerText = document.getElementById(`deleteModalLabel`);
        let contentText = document.getElementById('modalContent'); 

        headerText.innerHTML = 'Confirm Checkout';
        contentText.innerHTML = 'Are you sure you want to buy this item?';
    });

    document.getElementById(`checkoutBtnQRIS`).addEventListener('click', function() {
        
        let sbmtBtn = document.getElementById('sbmtBtn');

        sbmtBtn.setAttribute('form', `cartForm`);
        document.getElementById('cartForm').setAttribute('action', `/completeTransactionOther`);

        sbmtBtn.setAttribute('class', `btn btn-primary`);
        sbmtBtn.innerHTML = 'Submit';

        let headerText = document.getElementById(`deleteModalLabel`);
        let contentText = document.getElementById('modalContent'); 

        headerText.innerHTML = 'Confirm Checkout';
        contentText.innerHTML = 'Are you sure you want to buy this item?';
    });
});

async function configureShipmentButtons() {
    var provinceSelect = document.getElementById('provinceSelect');
    var citySelect = document.getElementById('citySelect');
    var districtSelect = document.getElementById('districtSelect');
    var courierSelect = document.getElementById('courierSelect');

    var defaultUrl = new URL(window.location.origin + '/api/shipment/getProvince');

    try {
        const provinceResponse = await fetch(defaultUrl.toString(), {
            method: 'POST'
        });
        
        if (!provinceResponse.ok) {
            throw new Error(`Response status: ${provinceResponse.status}`);
        }
        itemJson = await provinceResponse.json();
        
        provinceSelect.innerHTML = "";
        itemJson.data.data.forEach((province) => {
            const option = document.createElement('option');
            
            option.textContent = province.name;
            option.value = province.id;
            
            provinceSelect.appendChild(option);
        })

        configureCostEventChange(districtSelect, courierSelect);
        configureCitySelect(provinceSelect, citySelect);
        configureDistrictSelect(citySelect, districtSelect);

        provinceSelect.dispatchEvent(new Event('change'));

    } catch (error) {
        console.error(error.message);
    }
}

function configureCitySelect(provinceSelect, citySelect) {
    provinceSelect.addEventListener('change', async (event) => {
        try {
            const cityResponse = await fetch(window.location.origin + '/api/shipment/getCity', {
                method: 'POST',
                headers: {'Content-Type': 'application/json'},
                body: JSON.stringify({provinceId : provinceSelect.value})
            });
            
            if (!cityResponse.ok) {
                throw new Error(`Response status: ${cityResponse.status}`);
            }
            cityJson = await cityResponse.json();
            
            citySelect.innerHTML = "";
            cityJson.data.data.forEach((city) => {
                const optionCity = document.createElement('option');
                
                optionCity.textContent = city.name;
                optionCity.value = city.id;
                
                citySelect.appendChild(optionCity);
            })

            citySelect.dispatchEvent(new Event('change'));

        } catch (error) {
            console.error(error.message);
        }
    });
}

function configureDistrictSelect(citySelect, districtSelect) {
    citySelect.addEventListener('change', async (event) => {
        try {
            const districtResponse = await fetch(window.location.origin + '/api/shipment/getDistrict', {
                method: 'POST',
                headers: {'Content-Type': 'application/json'},
                body: JSON.stringify({cityId : citySelect.value})
            });
            
            if (!districtResponse.ok) {
                throw new Error(`Response status: ${districtResponse.status}`);
            }
            districtJson = await districtResponse.json();
            
            districtSelect.innerHTML = "";
            districtJson.data.data.forEach((district) => {
                const districtOption = document.createElement('option');
                
                districtOption.textContent = district.name;
                districtOption.value = district.id;
                
                districtSelect.appendChild(districtOption);
            })

            districtSelect.dispatchEvent(new Event('change'));
            
        } catch (error) {
            console.error(error.message);
        }
    });
}

async function evaluateShippingPrice() {
    var provinceValue = document.getElementById('provinceSelect').value;
    var cityValue = document.getElementById('citySelect').value;
    var districtValue = document.getElementById('districtSelect').value;
    var courierValue = document.getElementById('courierSelect').value;

    if(provinceValue && cityValue && districtValue && courierValue) {
        try {
            const costResponse = await fetch(window.location.origin + '/api/shipment/calculateCost', {
                method: 'POST',
                headers: {'Content-Type': 'application/json'},
                body: JSON.stringify({
                    destinationId : districtValue,
                    courierValue : courierValue
                })
            });
            
            if (!costResponse.ok) {
                throw new Error(`Response status: ${costResponse.status}`);
            }
            costJson = await costResponse.json();

            const idrFormatter = new Intl.NumberFormat('id-ID', {
                style: 'currency',
                currency: 'IDR',
            });
            document.getElementById('shippingCost').innerHTML = 'Shipping Cost:' + idrFormatter.format(costJson.data.data[0].cost);
            document.getElementById('shippingCostForm').value = costJson.data.data[0].cost;

            changeDestination();
        } catch (error) {
            console.error(error.message);
        }
    }
}

function changeDestination() {
    document.getElementById('provinceForm').value = document.getElementById('provinceSelect').selectedOptions[0].innerHTML;
    document.getElementById('cityForm').value = document.getElementById('citySelect').selectedOptions[0].innerHTML;
    document.getElementById('districtForm').value = document.getElementById('districtSelect').selectedOptions[0].innerHTML;
}

function configureCostEventChange(districtSelect, courierSelect) {
    courierSelect.addEventListener('change', evaluateShippingPrice);
    districtSelect.addEventListener('change', evaluateShippingPrice);
}
