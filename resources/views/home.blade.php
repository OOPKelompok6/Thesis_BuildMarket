<x-layout>
        {{-- Hero Banner Categories --}}
    <div id="heroCarousel" class="carousel slide" data-bs-ride="carousel">

        <div class="carousel-inner">
            @forelse($banners ?? [] as $index => $banner)
                <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                    @if($banner->image_url)
                        <img src="{{ asset($banner->image_url) }}" class="d-block w-100" alt="{{ $banner->title }}"
                            style="height: 280px; object-fit: cover;">
                        <div class="carousel-caption d-flex flex-column justify-content-center align-items-start h-100 top-0 start-0 text-start ps-5">
                            <h2 class="fw-bold text-light">{{ $banner->title }}</h2>
                            @if($banner->subtitle)
                                <p class="text-light">{{ $banner->subtitle }}</p>
                            @endif
                        </div>
                    @else
                        <div class="d-flex align-items-center justify-content-center"
                            style="height: 280px; background-color: #1e1e1e;">
                            <h1 class="text-light fw-normal" style="font-size: 3rem;">{{ $banner->title }}</h1>
                        </div>
                    @endif
                </div>
            @empty
                <div class="carousel-item active">
                    <div class="d-flex align-items-center justify-content-center"
                        style="height: 280px; background-color: #1e1e1e;">
                        <h1 class="text-light fw-normal" style="font-size: 3rem;">Category Highlight</h1>
                    </div>
                </div>
            @endforelse
        </div>

        <div class="carousel-indicators">
            @php $slideCount = max(count($banners ?? []), 1); @endphp
            @for($i = 0; $i < $slideCount; $i++)
                <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="{{ $i }}"
                    class="{{ $i === 0 ? 'active' : '' }}" aria-label="Slide {{ $i + 1 }}"></button>
            @endfor
        </div>

    </div>

    {{-- Brands --}}
    <div class="d-flex flex-column mx-4 mt-4">
        <p class="text-light fw-bold mb-3">Brands</p>

        <div class="d-flex flex-row gap-2 overflow-auto pb-1" style="scrollbar-width: none;">
            @forelse($brands ?? [] as $brand)
                <a href="/brands/{{ $brand->slug }}" style="text-decoration: none;">
                    <button type="button" class="btn btn-outline-light rounded-pill px-4 fw-normal text-nowrap">
                        {{ $brand->name }}
                    </button>
                </a>
            @empty
                @foreach(['Brand', 'Brand', 'Brand', 'Brand', 'Brand'] as $b)
                    <button type="button" class="btn btn-outline-light rounded-pill px-4 fw-normal">
                        {{ $b }}
                    </button>
                @endforeach
            @endforelse
        </div>
    </div>


    {{-- New Item --}}
    <div class="d-flex flex-column mx-4 mt-4">
        <div class="d-flex flex-row align-items-center border-bottom border-secondary pb-2 mb-3">
            <p class="text-light fw-bold mb-0">New Item Postings</p>
            <a href="/products?sort=newest" class="ms-auto text-secondary" style="text-decoration: none; font-size: 0.8rem;">
                View all
            </a>
        </div>

        <div id="newItemsCarousel" class="carousel slide" data-bs-ride="false">
            <div class="carousel-inner">
                @forelse($newProducts ?? [] as $index => $product)
                    @if($index % 3 === 0)
                        <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                            <div class="d-flex flex-row gap-3">
                    @endif

                    <div class="d-flex flex-row rounded-3 overflow-hidden flex-fill"
                        style="background-color: #1e1e1e; border: 1px solid #2e2e2e; max-width: 33%;">
                        <div style="width: 80px; min-height: 100px; background-color: #2a2a2a; flex-shrink: 0;"
                            class="d-flex align-items-center justify-content-center">
                            @if($product->thumbnail_url)
                                <img src="{{ asset($product->thumbnail_url) }}" alt="{{ $product->name }}"
                                    style="width: 80px; height: 100%; object-fit: cover;">
                            @else
                                <span class="text-secondary" style="font-size: 0.7rem;">Item Photo</span>
                            @endif
                        </div>
                        <div class="d-flex flex-column p-2 flex-fill">
                            <p class="text-light fw-bold mb-1" style="font-size: 0.8rem;">{{ $product->name }}</p>
                            <p class="text-secondary mb-1" style="font-size: 0.72rem; line-height: 1.4;">
                                {{ Str::limit($product->description, 80) }}
                            </p>
                            <a href="/products/{{ $product->slug }}" class="mt-auto"
                                style="font-size: 0.75rem; color: #aaa; text-decoration: none;">
                                View Item &rsaquo;
                            </a>
                        </div>
                    </div>

                    @if($index % 3 === 2 || $index === count($newProducts) - 1)
                            </div>
                        </div>
                    @endif
                @empty
                    <div class="carousel-item active">
                        <div class="d-flex flex-row gap-3">
                            @foreach(range(1, 3) as $i)
                                <div class="d-flex flex-row rounded-3 overflow-hidden flex-fill"
                                    style="background-color: #1e1e1e; border: 1px solid #2e2e2e; max-width: 33%;">
                                    <div style="width: 80px; min-height: 100px; background-color: #2a2a2a; flex-shrink: 0;"
                                        class="d-flex align-items-center justify-content-center">
                                        <span class="text-secondary" style="font-size: 0.7rem;">Item Photo</span>
                                    </div>
                                    <div class="d-flex flex-column p-2 flex-fill">
                                        <p class="text-light fw-bold mb-1" style="font-size: 0.8rem;">Item Name</p>
                                        <p class="text-secondary mb-1" style="font-size: 0.72rem; line-height: 1.4;">
                                            Deskripsi singkat mengenai produk ini. Stok ada, bisa purchase sekarang.
                                        </p>
                                        <a href="#" class="mt-auto" style="font-size: 0.75rem; color: #aaa; text-decoration: none;">
                                            View Item &rsaquo;
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforelse
            </div>

            <div class="carousel-indicators position-relative mt-3" style="bottom: unset;">
                @php $productPageCount = max(ceil(count($newProducts ?? [3]) / 3), 1); @endphp
                @for($i = 0; $i < $productPageCount; $i++)
                    <button type="button" data-bs-target="#newItemsCarousel" data-bs-slide-to="{{ $i }}"
                        class="{{ $i === 0 ? 'active' : '' }}" aria-label="Page {{ $i + 1 }}"
                        style="background-color: #555;"></button>
                @endfor
            </div>
        </div>
    </div>


    {{-- Bottom Spacer --}}
    <div class="mt-5"></div>

</x-layout>
