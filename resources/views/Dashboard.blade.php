<x-layout>
    <div class="d-flex flex-column w-100 min-vh-100 align-items-center">
        <div class="d-flex w-50 flex-column bg-light mx-auto my-auto rounded-5">
            <div style="height: 3.5rem" class="bg-dark p-0 m-0 w-100 rounded-top-5"></div>

            <div class="d-flex flex-row">
                <div style="flex: 1;" class="d-flex flex-column ms-3 my-4 rounded-3 border border-1"">
                    <div class="mx-2 my-1">
                        <p class="fs-6 fw-bold my-0">Total Sales</p>
                        <p class="my-2" style="font-size: 1rem;">{{ "Rp " . number_format($metricData->totalSold, 0, ',', '.') }}</p>
                    </div>
                </div>

                <div style="flex: 1;" class="d-flex flex-column mx-1 my-4 rounded-3 border border-1"">
                    <div class="mx-2 my-1">
                        <p class="fs-6 fw-bold my-0">Item Sold</p>
                        <p class="my-2" style="font-size: 1rem;">{{ $metricData->totalItemSold }} items</p>
                    </div>
                </div>

                <div style="flex: 1;" class="d-flex flex-column me-3 my-4 rounded-3 border border-1"">
                    <div class="mx-2 my-1">
                        <p class="fs-6 fw-bold my-0">Empty Stock Items</p>
                        <p class="my-2" style="font-size: 1rem;">{{ $emptyStockData }} items</p>
                        <a href="/itemManagement?emptyStock=true" class="ms-auto text-secondary" style="text-decoration: none; font-size: 0.8rem;">
                            View empty stock &rsaquo;
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="d-flex w-50 flex-column bg-light mx-auto my-auto rounded-5">
        
        </div>
    </div>
</x-layout>