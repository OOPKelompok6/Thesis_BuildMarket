@props(['product', 'cardWidth', 'cartItem'])

<div class="d-flex flex-row rounded-3 overflow-hidden"
        style="background-color: #ffffff; border: 1px solid #2e2e2e; max-width: {{ $cardWidth ?? '33%' }};">
    <div style="width: 80px; min-height: 100px; background-color: #ffffff; flex-shrink: 0;"
        class="d-flex align-items-center justify-content-center">
            <img src="
            @if ($product->category->name == 'Sanitary and bathroom')
                {{ secure_asset('images/cards/bathroom_thumbnail.png') }}
            @elseif ($product->category->name == 'Plumbing')
                {{ secure_asset('images/cards/plumbing_thumbnail.png') }}
            @elseif ($product->category->name == 'Flooring')
                {{ secure_asset('images/cards/flooring_thumbnail.png') }}
            @elseif ($product->category->name == 'Tools & Hardware')
                {{ secure_asset('images/cards/tools_thumbnail.png') }}
            @elseif ($product->category->name == 'Cement')
                {{ secure_asset('images/cards/cement_thumbnail.png') }}
            @endif
            "
            alt="{{ $product->name }}" style="width: 80px; object-fit: cover;">
    </div>
    <div class="d-flex flex-column p-2">
        <p class="text-secondary mb-1" style="font-size: 0.72rem; line-height: 1.4;">{{ $product->category->name }}<span class="ms-3">{{ $product->brand->name }}</span></p>
        <p class="text-dark fw-bold mb-1" style="font-size: 0.8rem;">{{ $product->name }}</p>
        <p class="text-secondary mb-1" style="font-size: 0.72rem; line-height: 1.4;">
            {{ Str::limit(clean($product->description, ['HTML.Allowed' => '']), 80) }}
        </p>

        <p class="text-dark fw-bold mb-1" style="font-size: 0.8rem;">{{ "Rp " . number_format($product->price, 0, ',', '.') }}</p>
        <div class="d-flex flex-row mt-2">
            <a href="/item/{{ $product->id }}" class="mt-auto me-5"
                style="font-size: 0.75rem; color: #7a7a7a; text-decoration: none;">
                View Item &rsaquo;
            </a>

            @auth
                @if (request()->routeIs('cart'))
                    @canany(['isSeller', 'isUser'])
                    
                        <input name="quantities[]" id="quantInput-{{ $cartItem->id }}" type="number" value="{{ $cartItem->quantity }}" min="1" max="{{ $product->quantity }}" class="form-control mt-auto me-1" style="width: 20%; height: 70%;">
                        <input class="d-none" name="indexes[]" type="number" value="{{ $cartItem->id }}">
                        <button id="buttonQuantInput-{{ $cartItem->id }}" type="button" data-bs-toggle="modal" data-bs-target="#deleteModal" class="bg-primary btn btn-sm mt-auto upd-btn" style="font-size: 0.8rem; height: 70%; width: 10%">
                            <i class="bi bi-upload"></i>
                        </button>

                        <button id="dltIdentifier-{{ $cartItem->id }}" type="button" class="mt-auto ms-4 dlt-btn" data-bs-toggle="modal" data-bs-target="#deleteModal"
                            style="font-size: 0.75rem; color: #e50808; text-decoration: none;  background: none; border: none;">
                            Delete Item &rsaquo;
                        </button>
                    @endcan

                @elseif(request()->routeIs('transactionInvDetail'))
                    @canany(['isSeller', 'isUser'])
                        <p style="font-size: 0.8rem;" class="my-0">Quantity: {{$cartItem->quantity}}</p>
                    @endcan
                @endif
            @endauth
        </div>
    </div>
</div>