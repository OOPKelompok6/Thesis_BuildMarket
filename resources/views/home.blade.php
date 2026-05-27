<x-layout>
    <div id="heroCarousel" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
                <div class="carousel-item active">
                        <a href="/browseItem?category=Tools%20%26%20Hardware">
                        <img src="{{ secure_asset('images/tools_showcase.png') }}" class="d-block w-100" alt="ToolsShowcase"
                            style="height: 280px; object-fit: cover;">
                        </a>
                </div>
                <div class="carousel-item">
                        <a href="/browseItem?category=Flooring">
                        <img src="{{ secure_asset('images/flooring_showcase.png') }}" class="d-block w-100" alt="ToolsShowcase"
                            style="height: 280px; object-fit: cover;">
                        </a>
                </div>
                <div class="carousel-item">
                        <a href="/browseItem?category=Sanitary%20and%20bathroom">
                        <img src="{{ secure_asset('images/bathroom_appliances.png') }}" class="d-block w-100" alt="ToolsShowcase"
                            style="height: 280px; object-fit: cover;">
                        </a>
                </div>
                <div class="carousel-item">
                        <a href="/browseItem?category=Plumbing">
                        <img src="{{ secure_asset('images/plumbing_appliances.png') }}" class="d-block w-100" alt="ToolsShowcase"
                            style="height: 280px; object-fit: cover;">
                        </a>
                </div>
        </div>

        <div class="carousel-indicators">
            <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
            <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="3" aria-label="Slide 4"></button>
        </div>

    </div>

    <div class="d-flex flex-column mx-4 my-5">
        <div class="d-flex flex-row border-bottom border-secondary pb-2 mb-3">
            <p class="text-light fw-bold mb-0">Brands</p>
        </div>

        <div class="d-flex my-3 w-100">
            <a style="width: 20vw;" class="btn d-flex bg-light mx-1 rounded-3" href="/browseItem?brand=DeWalt">
                <img class="img-fluid mx-auto my-auto" src="{{ secure_asset('images/brands/dewalt.png') }}">
            </a>

            <a style="width: 20vw;" class="btn d-flex bg-light mx-1 rounded-3" href="/browseItem?brand=Bosch">
                <img class="img-fluid mx-auto my-auto" src="{{ secure_asset('images/brands/bosch.png') }}">
            </a>

            <a style="width: 20vw;" class="btn d-flex bg-light mx-1 rounded-3" href="/browseItem?brand=Makita">
                <img class="img-fluid mx-auto my-auto" src="{{ secure_asset('images/brands/makita.png') }}">
            </a>

            <a style="width: 20vw;" class="btn d-flex bg-light mx-1 rounded-3" href="/browseItem?brand=Milwaukee">
                <img class="img-fluid mx-auto my-auto" src="{{ secure_asset('images/brands/milwaukee.png') }}">
            </a>

            <a style="width: 20vw;" class="btn d-flex bg-light mx-1 rounded-3" href="/browseItem?brand=Tiga%20roda">
                <img class="img-fluid mx-auto my-auto" src="{{ secure_asset('images/brands/tigaRoda.png') }}">
            </a>
        </div>
    </div>

    <div class="d-flex flex-column mx-4 mt-4">
        <div class="d-flex flex-row align-items-center border-bottom border-secondary pb-2 mb-3">
            <p class="text-light fw-bold mb-0">New Item Postings</p>
            <a href="/browseItem?ordering=created_date-newest" class="ms-auto text-secondary" style="text-decoration: none; font-size: 0.8rem;">
                View all
            </a>
        </div>

        <div id="newItemsCarousel" class="carousel slide" data-bs-ride="false">
            <div class="carousel-inner">
                @foreach($newProducts ?? [] as $index => $product)
                    @if($index % 3 === 0)
                        <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                            <div class="d-flex flex-row gap-3">
                    @endif

                    <x-itemCards :product="$product"></x-itemCards>

                    @if($index % 3 === 2 || $index === count($newProducts) - 1)
                            </div>
                        </div>
                    @endif
                 @endforeach
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

    <div class="mt-5"></div>

</x-layout>