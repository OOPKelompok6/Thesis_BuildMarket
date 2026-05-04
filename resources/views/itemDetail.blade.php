<x-layout :customScript="[secure_asset('js/itemDetail.js')]" deffered="true">
    
    <div class="d-flex flex-row gap-4 mx-4 mt-4">

        {{-- Item Image --}}
        <div class="d-flex flex-column" style="width: 260px; flex-shrink: 0;">
            <div class="d-flex align-items-center justify-content-center rounded-3 overflow-hidden"
                style="width: 260px; height: 260px; background-color: #1e1e1e; border: 1px solid #2e2e2e;">
                <img src="
                @if ($item->category->name == 'Sanitary and bathroom')
                    {{ secure_asset('images/cards/bathroom_thumbnail.png') }}
                @elseif ($item->category->name == 'Plumbing')
                    {{ secure_asset('images/cards/plumbing_thumbnail.png') }}
                @elseif ($item->category->name == 'Flooring')
                    {{ secure_asset('images/cards/flooring_thumbnail.png') }}
                @elseif ($item->category->name == 'Tools & Hardware')
                    {{ secure_asset('images/cards/tools_thumbnail.png') }}
                @elseif ($item->category->name == 'Cement')
                    {{ secure_asset('images/cards/cement_thumbnail.png') }}
                @endif
                "
                alt="{{ $item->name }}" style="width: 100%; height: 100%; object-fit: contain;">
                
            </div>
        </div>

        {{-- Item Info --}}
        <div class="d-flex flex-column me-auto">
            <p class="text-light fw-bold fs-5 mb-1">{{ $item->name }}</p>
            <p id="priceTag" style="opacity:60%" class="text-light fw-bold fs-3 mb-1">
                {{ "Rp " . number_format($item->price, 0, ',', '.') }}
            </p>
            <p style="opacity:60%" class="text-light fw-bold fs-6 mb-1">Brand: {{ $item->brand->name }}</p>
            <p style="opacity:60%" class="text-light fw-bold fs-6 mb-1">Category: {{ $item->category->name }}</p>
            <p style="opacity:60%" class="text-light fw-bold fs-6 mb-1">Stock: {{ $item->quantity }}</p>
        </div>

        {{-- Add to Cart Box --}}
        @auth
            <div class="d-flex flex-column ms-auto" style="width: 220px; flex-shrink: 0;">
                <div class="bg-light d-flex flex-column rounded-3 p-3">
                    <label for="quantInput" class="fw-bold fs-5 mb-2">Quantity</label>

                    <form method="POST" action="@can('isOnCart', $item){{ '/cart/' . $item->cart_items->where('user_id', Auth::user()->id)->first()->id }}@else{{ '/addToCart' }}@endcan">
                        @csrf
                        <input type="hidden" name="itemId" value="{{ $item->id }}">

                        <div class="d-flex flex-row align-items-center gap-2 mb-2">
                            <button type="button" id="decrementBtn"
                                class="btn btn-outline-secondary btn-sm px-2 py-0" style="font-size: 1rem;">−</button>
                            <input id="quantInput" class="form-control text-center" style="width: 60px;"
                                min="1" value="1" max="{{ $item->quantity }}" type="number" name="quantity">
                            <button type="button" id="incrementBtn"
                                class="btn btn-outline-secondary btn-sm px-2 py-0" style="font-size: 1rem;">+</button>
                        </div>

                        <p id="subtotalCalc" class="text-dark fw-bold fs-5 mb-2">
                            Sub Total: {{ "Rp " . number_format($item->price, 0, ',', '.') }}
                        </p>

                        @canany(['isSeller', 'isUser'])
                            <div class="d-flex flex-row">
                                <button type="submit" class="ms-auto btn btn-primary text-light">
                                    @can('isOnCart', $item)
                                        Update
                                    @else
                                        Add to cart
                                    @endcan
                                </button>
                            </div>
                        @endcanany
                    </form>
                </div>
            </div>
        @endauth

    </div>

{{--Description --}}
    <div class="d-flex flex-column mx-4 my-5">
        <div class="d-flex flex-row border-bottom border-secondary pb-2 mb-3">
            <p class="text-light fw-bold mb-0">Description</p>
        </div>
        <div class="d-flex flex-column my-3 w-100 text-light">
            {!! $item->description !!}
        </div>
    </div>

{{-- Reviews --}}
    <div class="d-flex flex-column mx-4 my-5">
        <div class="d-flex flex-row border-bottom border-secondary pb-2 mb-3">
            <p class="text-light fw-bold mb-0">Reviews</p>
        </div>

        <div class="mb-3">
            <form method="POST" action="/postReview/{{ $item->id }}">
                @csrf
                <label for="reviewTextarea" class="form-label text-light">Leave a review</label>
                <textarea name="review" class="form-control" id="reviewTextarea" rows="3"
                    @canany(['alreadyReviewed', 'hasNotBought'], $item)
                        disabled
                    @endcanany
                ></textarea>
                <div class="d-flex flex-grow-1 my-3">
                    <button type="submit"
                        @canany(['alreadyReviewed', 'hasNotBought'], $item) disabled @endcanany
                        class="ms-auto btn btn-primary text-light">
                        Submit
                    </button>
                </div>
            </form>
        </div>

        <div class="mb-1">
            @forelse($reviews as $review)
                <div class="d-flex mb-3 flex-column w-100">
                    <div class="d-flex bg-dark rounded-3 w-100">
                        <p class="p-3 text-light fs-6 mb-0">{{ $review->review }}</p>
                    </div>
                    <p style="font-size:0.6rem" class="text-light mt-1 mb-0">
                        By {{ $review->user->firstName }} {{ $review->user->lastName }}
                    </p>
                </div>
            @empty
                <p class="text-secondary" style="font-size: 0.85rem;">No reviews yet.</p>
            @endforelse
        </div>

        <div class="my-2 ms-auto">
            {{ $reviews->links() }}
        </div>
    </div>

    {{--SIMILAR ITEMS--}}
    <div class="d-flex flex-column mx-4 my-5">
        <div class="d-flex flex-row border-bottom border-secondary pb-2 mb-3">
            <p class="text-light fw-bold mb-0">Similar Item</p>
        </div>

        <div id="similarCarousel" class="carousel slide" data-bs-ride="false">
            <div class="carousel-inner">
                @forelse($similarItems as $index => $product)
                    @if($index % 3 === 0)
                        <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                            <div class="d-flex flex-row gap-3">
                    @endif

                    <x-itemCards :product="$product"></x-itemCards>

                    @if($index % 3 === 2 || $index === count($similarItems) - 1)
                            </div>
                        </div>
                    @endif
                @empty
                    <div class="carousel-item active">
                        <p class="text-secondary" style="font-size: 0.85rem;">No similar items found.</p>
                    </div>
                @endforelse
            </div>

            <div class="carousel-indicators position-relative mt-3" style="bottom: unset;">
                @php $similarPageCount = max(ceil(count($similarItems) / 3), 1); @endphp
                @for($i = 0; $i < $similarPageCount; $i++)
                    <button type="button" data-bs-target="#similarCarousel" data-bs-slide-to="{{ $i }}"
                        class="{{ $i === 0 ? 'active' : '' }}" aria-label="Page {{ $i + 1 }}"
                        style="background-color: #555;"></button>
                @endfor
            </div>
        </div>
    </div>

    <div class="mt-5"></div>

</x-layout>