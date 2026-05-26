<x-layout :customScript="[secure_asset('js/cart.js')]" deffered="true">
    <div class="d-flex flex-column mx-4 mt-4">

        <div class="d-flex flex-row border-bottom border-secondary pb-2 mb-3">
            <p class="text-light fw-bold mb-0">My Cart</p>
        </div>

        <form id="cartForm" method="POST" action="/completeTransaction" class="d-flex flex-row w-100">
            @csrf

            <div class="d-flex flex-column w-28">
                <div class="bg-light rounded-3 mx-3 my-5 w-100">
                    <p class="text-dark fs-4 fw-bold ms-2 my-2">Payments</p>
                    
                    <div id="carouselExample" class="carousel slide my-4">
                        <div class="carousel-inner">
                            @foreach ($payments ?? [] as $index => $payment)
                                <div class="carousel-item @if($index === 0) active @endif">
                                    <label style="cursor: pointer;" class="d-flex flex-column flex-grow-1 mx-5 rounded-3 border border-1" for="payment-{{ $payment->id }}">
                                        <input class="d-none" id="payment-{{ $payment->id }}" type="radio" value="{{ $payment->id }}" name="payment_id"/>
                                            <div class="mx-2 my-1">
                                                <p class="fs-6 fw-bold my-0">{{ $payment->vendor }}</p>
                                                <p class="my-0" style="font-size: 0.8rem;">{{ $payment->cardNumber }}</p>
                                                <p class="my-0" style="font-size: 0.8rem;">{{ $payment->billingAddress }}</p>
                                                <p class="my-0" style="font-size: 0.8rem; opacity: 80%;">{{ $payment->expiration_Date }}</p>
                                            </div>
                                    </label>
                                </div>
                            @endforeach
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>

                    <div class="d-flex flex-column w-100 align-items-center">
                        {{ $cartItems->links() }}
                    </div>
                </div>

                <div class="bg-light rounded-3 mx-3 my-5 w-100">
                    <p class="text-dark fs-4 fw-bold ms-2 my-2">Shipments</p>
                    
                    <div class="mb-3 mx-2">
                        <label for="courierSelect" class="form-label">Courier</label>
                        <select id="courierSelect" class="form-select" name="courier">
                            <option value="jne">JNE</option>
                            <option value="pos">POS Indonesia</option>
                            <option value="sicepat">SiCepat</option>
                        </select>
                    </div>

                    <div class="mb-3 mx-2">
                        <label for="provinceSelect" class="form-label">Province</label>
                        <select id="provinceSelect" class="form-select" name="provinceId">
                        </select>
                    </div>

                    <div class="mb-3 mx-2">
                        <label for="citySelect" class="form-label">City</label>
                        <select id="citySelect" class="form-select" name="cityId">
                        </select>
                    </div>

                    <div class="mb-3 mx-2">
                        <label for="districtSelect" class="form-label">District</label>
                        <select id="districtSelect" class="form-select" name="districtId">
                        </select>
                    </div>
                </div>
            </div>

            <div class="d-flex flex-column w-72">
                @forelse($cartItems ?? [] as $index => $cartItem)
                    @if($index % 2 === 0)
                        <div class="d-flex flex-row-reverse gap-2 mb-5">
                    @endif

                    <x-itemCards :product="$cartItem->item" :cartItem="$cartItem" cardWidth="48%"></x-itemCards>

                    @if($index % 2 === 1 || $index === count($cartItems) - 1)
                        </div>
                    @endif
                @empty
                    <div class="d-flex flex-column align-items-center justify-content-center mt-5">
                        <p class="text-secondary">Your cart is empty.</p>
                        <a href="/browseItem" class="btn btn-outline-light btn-sm mt-2">Browse Items</a>
                    </div>
                @endforelse
            </div>

            <input value="{{ $totalPrice }}" type="number" class="form-control d-none" id="totalCostForm" name="totalCost">
            <input type="number" class="form-control d-none" id="shippingCostForm" name="shippingCostValue">

            <input type="text" class="form-control d-none" id="provinceForm" name="provinceValue">
            <input type="text" class="form-control d-none" id="cityForm" name="cityValue">
            <input type="text" class="form-control d-none" id="districtForm" name="districtValue">
        </form>

        {{-- Total --}}
        @if(count($cartItems) > 0)
            <div class="d-flex flex-row justify-content-end mt-3 border-top border-secondary pt-3">
                <div class="d-flex flex-column align-items-end">
                    <p class="text-light fw-bold fs-5 mb-3">
                        Total: {{ "Rp " . number_format($totalPrice, 0, ',', '.') }}
                    </p>
                    <p id="shippingCost" class="text-light fs-6 mb-4">
                        Shipping Cost: Rp 0
                    </p>
                    <div class="gap-3 d-flex flex-row">
                        <button id="checkoutBtnQRIS" data-bs-toggle="modal" data-bs-target="#deleteModal" class="btn btn-primary text-light px-4">Checkout With Other Methods</button>
                        <button id="checkoutBtn" data-bs-toggle="modal" data-bs-target="#deleteModal" class="btn btn-primary text-light px-4">Checkout</button>
                    </div>
                </div>
            </div>
        @endif
    </div>

    <!-- Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModal" aria-hidden="true">
        <form id="deleteForm" class="d-none" method="POST">@csrf @method('DELETE')</form>
        <form id="updateForm" class="d-none" method="POST">
            @csrf
            <input id="updateFinInput" name="quantity" type="number" min="1" class="d-none">
        </form>
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="deleteModalLabel">Confirm Deletion</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div id="modalContent" class="modal-body">
                Are you sure you want to delete this item?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Cancel</button>
                <button id="sbmtBtn" type="submit" class="btn btn-danger">Delete</button>
            </div>
            </div>
        </div>
    </div>

    <div class="mt-5"></div>
</x-layout>