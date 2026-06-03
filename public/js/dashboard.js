document.addEventListener("DOMContentLoaded", () => {
    var exportBtn = document.getElementById('exportBtn');

    exportBtn.addEventListener('click', (event) => {
        const queryString = window.location.search;
        const urlParams = new URLSearchParams(queryString);

        let startDate = urlParams.get('startDate');
        let endDate = urlParams.get('endDate');
        console.log(startDate);
        console.log(endDate);

        var url = "/dashboard/export"

        if(startDate) {
            url = url + `?startDate=${startDate}`;
        }

        if(endDate) {
            if(!startDate) {
                url = url + '?';
            }

            url = url + `&endDate=${endDate}`;
        }

        exportBtn.setAttribute('href', url);
    });
});
