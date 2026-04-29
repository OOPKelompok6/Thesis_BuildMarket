<x-layout>
    <div class="d-flex flex-column mx-4 mt-4">

        <div class="d-flex flex-row border-bottom border-secondary pb-2 mb-3">
            <p class="text-light fw-bold mb-0">My Cart</p>
        </div>

        @forelse($cartItems as $cartItem)
            <div class="d-flex flex-row align-items-center rounded-3 mb-3 p-3"
                style="background-color: #1e1e1e; border: 1px solid #2e2e2e;">

                {{-- Item Image --}}
                <div class="d-flex align-items-center justify-content-center rounded-3 overflow-hidden me-3"
                    style="width: 80px; height: 80px; background-color: #2a2a2a; flex-shrink: 0;">
                    @if($cartItem->item->image_url)
                        <img src="{{ asset($cartItem->item->image_url) }}" alt="{{ $cartItem->item->name }}"
                            style="width: 100%; height: 100%; object-fit: cover;">
                    @else
                        <span class="text-secondary" style="font-size: 0.7rem;">No Image</span>
                    @endif
                </div>

                {{-- Item Info --}}
                <div class="d-flex flex-column me-auto">
                    <a href="/item/{{ $cartItem->item->id }}" class="text-light fw-bold mb-1"
                        style="font-size: 0.9rem; text-decoration: none;">
                        {{ $cartItem->item->name }}
                    </a>
                    <p class="text-secondary mb-0" style="font-size: 0.8rem;">
                        {{ $cartItem->item->brand->name }} · {{ $cartItem->item->category->name }}
                    </p>
                    <p class="text-light mb-0" style="font-size: 0.85rem;">
                        {{ "Rp " . number_format($cartItem->item->price, 0, ',', '.') }}
                    </p>
                </div>

                {{-- Quantity & Subtotal --}}
                <div class="d-flex flex-column align-items-end gap-2">
                    <p class="text-light fw-bold mb-0" style="font-size: 0.85rem;">
                        Qty: {{ $cartItem->quantity }}
                    </p>
                    <p class="text-light fw-bold mb-0" style="font-size: 0.9rem;">
                        {{ "Rp " . number_format($cartItem->item->price * $cartItem->quantity, 0, ',', '.') }}
                    </p>

                    {{-- Delete --}}
                    <form method="POST" action="/cart/{{ $cartItem->id }}">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-outline-danger">Remove</button>
                    </form>
                </div>

            </div>
        @empty
            <div class="d-flex flex-column align-items-center justify-content-center mt-5">
                <p class="text-secondary">Your cart is empty.</p>
                <a href="/browseItem" class="btn btn-outline-light btn-sm mt-2">Browse Items</a>
            </div>
        @endforelse

        {{-- Total --}}
        @if(count($cartItems) > 0)
            <div class="d-flex flex-row justify-content-end mt-3 border-top border-secondary pt-3">
                <div class="d-flex flex-column align-items-end">
                    <p class="text-light fw-bold fs-5 mb-3">
                        Total: {{ "Rp " . number_format($cartItems->sum(fn($c) => $c->item->price * $c->quantity), 0, ',', '.') }}
                    </p>
                    <a href="/checkout" class="btn btn-primary text-light px-4">Checkout</a>
                </div>
            </div>
        @endif

    </div>

    <div class="mt-5"></div>
</x-layout>