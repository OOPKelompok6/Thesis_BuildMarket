var uploadCollection;
var deleteCollection;

document.addEventListener("DOMContentLoaded", () => {
    uploadCollection = document.querySelectorAll('.upd-btn');
    deleteCollection = document.querySelectorAll('.dlt-btn');

    uploadCollection.forEach(updBtn => {
        updBtn.addEventListener('click', function() {
            
            let updId = updBtn.id;
            updId = updId.replace(/\D/g, ""); 
            
            let inpElement = document.getElementById(`quantInput-${updId}`);
            let updateForm = document.getElementById('updateForm');
            let updateInput = document.getElementById('updateFinInput');
            let sbmtBtn = document.getElementById('sbmtBtn');

            updateInput.value = inpElement.value;
            updateForm.setAttribute('action', `cart/${updId}`);
            sbmtBtn.setAttribute('form', `updateForm`);

            sbmtBtn.setAttribute('class', `btn btn-primary`);
            sbmtBtn.innerHTML = 'Update';

            let headerText = document.getElementById(`deleteModalLabel`);
            let contentText = document.getElementById('modalContent'); 

            headerText.innerHTML = 'Confirm Update';
            contentText.innerHTML = 'Are you sure you want to update this item?';
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
