<x-layout :customScript="[secure_asset('js/dashboard.js')]" deffered="true">
    <div class="d-flex flex-column w-100 min-vh-100 align-items-center">
        
        <div class="d-flex flex-row w-75 my-4">
            <div style="flex: 1 1 auto;" class="flex-grow-1 me-3 d-flex flex-column bg-light mx-auto my-auto rounded-5">
                <form class="d-flex flex-column" method="GET" action="/dashboard">
                    @csrf

                    <div class="mb-3 my-4 mx-2">
                        <label for="startDate" class="form-label">Start Date</label>
                        <input type="date" name="startDate" class="form-control" id="startDate" aria-describedby="startDate">
                    </div>

                    <div class="mb-3 mx-2">
                        <label for="endDate" class="form-label">End Date</label>
                        <input type="date" name="endDate" class="form-control" id="endDate" aria-describedby="endDate">
                    </div>

                    <div class="ms-auto me-3 mb-3">
                        <button type="submit" class="btn btn-primary text-light px-4">
                            Set Date
                        </button>
                    </div>
                </form>
            </div>

            <div style="flex: 1 1 auto;" class="flex-grow-1 d-flex flex-column bg-light mx-auto my-auto rounded-5">
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
        </div>

        <div style="width= 90% !important;" class="d-flex flex-column bg-light mx-auto mt-2 mb-5 rounded-5">
            @if (count($transactions) == 0)
                <p class="fs-3 text-dark mx-auto my-5">Empty Transaction List</p>
            @else
                <div class="text-dark w-75 me-auto my-4 ms-4 fs-3 fw-bold">Transaction List</div>
                <div class="d-flex flex-row mx-auto mb-4">
                    <table class="table table-striped table-borderless">

                        <thead>
                            <tr>
                                <th scope="col"><div class="d-flex"><span class="mx-auto">Transaction ID</span></div></th>
                                <th scope="col"><div class="d-flex"><span class="mx-auto">Date</span></div></th>
                                <th scope="col"><div class="d-flex"><span class="mx-auto">Total</span></div></th>
                                <th scope="col"><div class="d-flex"><span class="mx-auto">Payment Method</span></div></th>
                                <th scope="col"><div class="d-flex"><span class="mx-auto">Price</span></div></th>
                                <th scope="col"><div class="d-flex"><span class="mx-auto">Shipping Cost</span></div></th>
                                <th style="width: 60px; scope="col"><div class="d-flex"><span class="mx-auto">Location</span></div></th>
                                <th style="width: 60px; scope="col"><div class="d-flex"><span class="mx-auto">District</span></div></th>
                                <th style="width: 60px; scope="col"><div class="d-flex"><span class="mx-auto">Sub District</span></div></th>
                                <th scope="col"><div class="d-flex"><span class="mx-auto">View Item</span></div></th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($transactions as $transaction)
                            <tr>
                                <td class="text-center">{{ $transaction->transaction_header->id }}</td>
                                <td class="text-center">{{ (new DateTime($transaction->transaction_header->created_at))->format('Y-m-d') }}</td>
                                <td class="text-center">{{ "Rp " . number_format(($transaction->quantity * $transaction->item->price), 0, ',', '.') }}</td>
                                <td class="text-center">{{ $transaction->transaction_header->payment->vendor }}</td>
                                <td class="text-center">{{ "Rp " . number_format($transaction->item->price, 0, ',', '.') }}</td>
                                <td class="text-center">{{ "Rp " . number_format($transaction->transaction_header->shipping_cost, 0, ',', '.') }}</td>
                                <td class="text-center">{{ $transaction->transaction_header->address->province }}</td>
                                <td class="text-center">{{ $transaction->transaction_header->address->city }}</td>
                                <td class="text-center">{{ $transaction->transaction_header->address->district }}</td>
                                <td class="text-center">
                                    <div class="d-flex">
                                        <a class="my-auto mx-auto" href="itemManagement?name={{ $transaction->item->name }}">
                                            <i class="bi bi-box"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="d-flex flex-row">
                    <div class="d-flex me-auto ms-5 gap-2">
                        {{ $transactions->links() }}
                    </div>

                    <a id="exportBtn" style="text-decoration: none;" class="me-5 pe-2 fs-5 mb-2" href="/dashboard/export/"><i class="bi bi-file-earmark-excel"></i>Export</a>
                </div>
            @endif
        </div>
    </div>
</x-layout>