@props(['product', 'cardWidth'])

<div class="d-flex flex-row rounded-3 overflow-hidden"
        style="background-color: #1e1e1e; border: 1px solid #2e2e2e; max-width: {{ $cardWidth ?? '33%' }};">
    <div style="width: 80px; min-height: 100px; background-color: #2a2a2a; flex-shrink: 0;"
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
        <p class="text-light fw-bold mb-1" style="font-size: 0.8rem;">{{ $product->name }}</p>
        <p class="text-secondary mb-1" style="font-size: 0.72rem; line-height: 1.4;">
            {{ Str::limit($product->description, 80) }}
        </p>

        <p class="text-light fw-bold mb-1" style="font-size: 0.8rem;">{{ "Rp " . number_format($product->price, 0, ',', '.') }}</p>
        <div class="d-flex flex-row gap-5 mt-2">
            <a href="/products/{{ $product->slug }}" class="mt-auto"
                style="font-size: 0.75rem; color: #aaa; text-decoration: none;">
                View Item &rsaquo;
            </a>

            @auth
                @canany(['isSeller', 'isAdmin'])
                    @if (request()->is('/ownItems'))
                        @can('isSeller')
                            <a href="/products/{{ $product->slug }}" class="mt-auto"
                                style="font-size: 0.75rem; color: #0a11e5; text-decoration: none;">
                                Edit Item &rsaquo;
                            </a>
                        @endcan

                        <a href="/item/{{ $product->slug }}" class="mt-auto"
                            style="font-size: 0.75rem; color: #e50808; text-decoration: none;">
                            Delete Item &rsaquo;
                        </a>
                    @endif
                @endcan
            @endauth
        </div>
    </div>
</div>