<x-layout>
    <div class="d-flex flex-column mx-4 mt-4">

        <div class="d-flex flex-row border-bottom border-secondary pb-2 mb-3">
            <p class="text-light fw-bold mb-0">My Cart</p>
        </div>

        <div id="cartForm" class="d-flex flex-row w-100">

            <div class="d-flex flex-column w-28">
                <div class="bg-light rounded-3 mx-3 my-5 w-100">
                    <p class="text-dark fs-4 fw-bold ms-2 my-2">Payment</p>
                    
                    <div>
                        <label style="cursor: pointer;" class="d-flex flex-column flex-grow-1 mx-5 mb-3 rounded-3 border border-1" for="payment-{{ $payment->id }}">
                            <input class="d-none" id="payment-{{ $payment->id }}" type="radio" value="{{ $payment->id }}" name="payment_id"/>
                                <div class="mx-2 my-1">
                                    <p class="fs-6 fw-bold my-0">{{ $payment->vendor }}</p>
                                    <p class="my-0" style="font-size: 0.8rem;">{{ $payment->cardNumber }}</p>
                                    <p class="my-0" style="font-size: 0.8rem;">{{ $payment->billingAddress }}</p>
                                    <p class="my-0" style="font-size: 0.8rem; opacity: 80%;">{{ $payment->expiration_Date }}</p>
                                </div>
                        </label>
                    </div>

                    <div class="d-flex flex-column w-100 align-items-center">
                        {{ $transactionItems->links() }}
                    </div>
                </div>

                <div class="bg-light rounded-3 mx-3 my-5 w-100">
                    <p class="text-dark fs-4 fw-bold ms-2 my-2">Shipment</p>
                    
                    <div>
                        <div class="d-flex flex-column flex-grow-1 mx-5 mb-3 rounded-3 border border-1">
                            <div class="mx-2 my-1">
                                <p class="fs-6 fw-bold my-0">
                                    @if ($courier == 'jne')
                                        JNE
                                    @elseif($courier == 'pos')
                                        POS Indonesia
                                    @elseif($courier == 'sicepat')
                                        SiCepat
                                    @endif
                                </p>
                                <p class="my-0" style="font-size: 0.8rem;">{{ $provinceValue }}</p>
                                <p class="my-0" style="font-size: 0.8rem;">{{ $cityValue }}</p>
                                <p class="my-0" style="font-size: 0.8rem; opacity: 80%;">{{ $districtValue }}</p>
                                <p class="my-0" style="font-size: 0.8rem; opacity: 80%;">{{ "Rp " . number_format($shipping_cost, 0, ',', '.') }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex flex-column w-100 align-items-center">
                        {{ $transactionItems->links() }}
                    </div>
                </div>
            </div>

            <div class="d-flex flex-column w-72">
                @forelse($transactionItems ?? [] as $index => $transactionItem)
                    @if($index % 2 === 0)
                        <div class="d-flex flex-row-reverse gap-2 mb-5">
                    @endif

                    <x-itemCards :product="$transactionItem->item" :cartItem="$transactionItem" cardWidth="48%"></x-itemCards>

                    @if($index % 2 === 1 || $index === count($transactionItems) - 1)
                        </div>
                    @endif
                @empty
                    <div class="d-flex flex-column align-items-center justify-content-center mt-5">
                        <p class="text-secondary">Your Transaction is empty.</p>
                    </div>
                @endforelse
            </div>
        </div>

        {{-- Total --}}
        @if(count($transactionItems) > 0)
            <div class="d-flex flex-row justify-content-end mt-3 border-top border-secondary pt-3">
                <div class="d-flex flex-column align-items-end">
                    <p class="text-light fw-bold fs-5 mb-3">
                        Total: {{ "Rp " . number_format($totalPrice, 0, ',', '.') }}
                    </p>
            </div>
        @endif
    </div>

    <div class="mt-5"></div>
</x-layout>