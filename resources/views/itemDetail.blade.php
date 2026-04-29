<x-layout :customScript="[secure_asset('js/itemDetail.js')]" deffered="true">
    <div class="d-flex flex-row gap-5">
        <div class="d-flex flex-column me-auto ms-4 my-4">
            <p class="text-light fw-bold fs-5">{{$item->name}}</p>
            <p id="priceTag" style="opacity:60%" class="text-light fw-bold fs-3">{{"Rp " . number_format($item->price, 0, ',', '.')}}</p>
            <p style="opacity:60%" class="text-light fw-bold fs-6">Category: {{$item->category->name}}</p>
            <p style="opacity:60%" class="text-light fw-bold fs-6">Brand: {{$item->brand->name}}</p>
            <p style="opacity:60%" class="text-light fw-bold fs-6">Stock: {{$item->quantity}}</p>
        </div>
        
        @auth
            <div class="d-flex flex-column ms-auto my-4 me-4">
                <div style="width: 100%; margin-right: 8.5rem;" class="bg-light d-flex flex-column rounded-3">
                    <form method="POST" action="@can('isOnCart', $item){{ trim('/updateCart') }}@else{{ trim('/addToCart') }}@endcan">
                        @csrf

                        <input id="itemId" value="{{ $item->id }}"" class="form-control w-50 ms-3 mt-1" type="hidden" name="itemId">
                        <label for="quantity" class="fw-bold fs-5 mt-1 ms-3">Quantity</label >
                        <input id="quantInput" class="form-control w-50 ms-3 mt-1" min="1" value="1" max="{{ $item->quantity }}" type="number" name="quantity">
                        <p id="SubtotalCalc" class="text-dark ms-3 fw-bold fs-4 mt-1">Subtotal: {{"Rp " . number_format($item->price, 0, ',', '.')}}</p>
                        @canany(['isSeller', 'isUser'])
                            <div class="d-flex flex-row flex-grow-1">
                                <button type="submit" action="" class="ms-auto me-3 btn bg-primary text-light mb-2">
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

    <div class="d-flex flex-column mx-4 my-5">
        <div class="d-flex flex-row border-bottom border-secondary pb-2 mb-3">
            <p class="text-light fw-bold mb-0">Description</p>
        </div>

        <div class="d-flex flex-column my-3 w-100 text-light">
            {!! $item->description !!}
        </div>
    </div>

    <div class="d-flex flex-column mx-4 my-5">
        <div class="d-flex flex-row border-bottom border-secondary pb-2 mb-3">
            <p class="text-light fw-bold mb-0">Reviews</p>
        </div>

        <div class="mb-3">
            <form method="POST" action="/postReview/{{ $item->id }}">
                @csrf

                <label for="FormControlTextarea" class="form-label text-light">Leave a review</label>
                <textarea name="review" class="form-control id="FormControlTextarea" rows="3"
                    @canany(['alreadyReviewed', 'hasNotBought'], $item)
                        disabled
                    @endcanany
                ></textarea>

                <div class="d-flex flex-grow-1 my-3">
                    <button type="submit" @canany(['alreadyReviewed', 'hasNotBought'], $item) disabled @endcanany class="ms-auto btn bg-primary text-light mb-2">Submit</button>
                </div>
            </form>
        </div>

        {{-- reviews with pagination --}}
        <div class="mb-1">
            @foreach ($reviews as $review)
                <div class="d-flex mb-3 flex-column w-100">
                    <div class="d-flex bg-dark rounded-3 w-100">
                        <p class="p-3 text-light fs-6">
                            {{ $review->review }}
                        </p>
                    </div>
                    <p style="font-size:0.6rem" class="text-light">By {{ $review->user->firstName }} {{ $review->user->lastName }}</p>
                </div>
            @endforeach
        </div>

        <div class="my-2 ms-auto">
            {{  $reviews->links() }}
        </div>
    </div>
</x-layout>