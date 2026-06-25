<table>
    <thead>
        <tr>
            <th scope="col"><div class="d-flex"><span class="mx-auto">Transaction ID</span></div></th>
            <th scope="col"><div class="d-flex"><span class="mx-auto">Date</span></div></th>
            <th scope="col"><div class="d-flex"><span class="mx-auto">Total</span></div></th>
            <th scope="col"><div class="d-flex"><span class="mx-auto">Payment Method</span></div></th>
            <th scope="col"><div class="d-flex"><span class="mx-auto">Price</span></div></th>
            <th scope="col"><div class="d-flex"><span class="mx-auto">Shipping Cost</span></div></th>
            <th scope="col"><div class="d-flex"><span class="mx-auto">Location</span></div></th>
            <th scope="col"><div class="d-flex"><span class="mx-auto">District</span></div></th>
            <th scope="col"><div class="d-flex"><span class="mx-auto">Sub District</span></div></th>
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
        </tr>
    @endforeach
    </tbody>
</table>