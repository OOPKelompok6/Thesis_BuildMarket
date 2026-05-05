<x-layout>
    <div class="d-flex flex-column w-100 min-vh-100 align-items-center">
        <div class="d-flex w-50 flex-column bg-light mx-auto my-auto rounded-5">
            <div style="height: 3.5rem" class="bg-dark p-0 m-0 w-100 rounded-top-5"></div>

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
                                <th scope="col"><div class="d-flex"><span class="mx-auto">Amount</span></div></th>
                                <th scope="col"><div class="d-flex"><span class="mx-auto">Payment Method</span></div></th>
                                <th scope="col"><div class="d-flex"><span class="mx-auto">Action</span></div></th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($transactions as $transaction)
                            <tr>
                                <td class="text-center">{{ $transaction->id }}</td>
                                <td class="text-center">{{ (new DateTime($transaction->created_at))->format('Y-m-d') }}</td>
                                <td class="text-center">{{ "Rp " . number_format($transaction->total, 0, ',', '.') }}</td>
                                <td class="text-center">{{ $transaction->vendor }}</td>
                                <td class="text-center">
                                    <div class="d-flex">
                                        <a class="my-auto mx-auto" href="transactionDetail/{{ $transaction->id }}">
                                            <i class="bi bi-search"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="d-flex ms-auto me-5 gap-2">
                    {{ $transactions->links() }}
                </div>
            @endif
        </div>
    </div>
</x-layout>