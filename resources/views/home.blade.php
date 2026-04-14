<x-layout>
    <div id="carouselMain" class="carousel slide mx-4 my-5 pb-5 pt-3 px-5">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselMain" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselMain" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselMain" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <a class="d-flex mx-auto" href="/browseItem">
                    <img class="mx-auto img-fluid" src="{{ secure_asset('images/bathroom_appliances.png') }}">
                </a>
            </div>
            <div class="carousel-item">
                <a class="d-flex mx-auto" href="/browseItem">
                    <img class="mx-auto img-fluid" src="{{ secure_asset('images/flooring_showcase.png') }}">
                </a>
            </div>
            <div class="carousel-item">
                <a class="d-flex mx-auto" href="/browseItem">
                    <img class="mx-auto img-fluid" src="{{ secure_asset('images/tools_showcase.png') }}">
                </a>
            </div>
        </div>
    </div>

    <div class="d-flex flex-column w-100">
        <p class="fs-3 my-auto ms-3 me-auto text-light">
            Brands
        </p>
        <hr class="bg-light my-0 mx-3 hr-custom">

        <div class="d-flex my-3">
            <a class="btn d-flex bg-light mx-1 flex-fill rounded-3" href="/browseItem">
                <img class="img-fluid mx-auto my-auto" src="{{ secure_asset('images/brands/dewalt.png') }}">
            </a>

            <a class="btn d-flex bg-light mx-1 flex-fill rounded-3" href="/browseItem">
                <img class="img-fluid mx-auto my-auto" src="{{ secure_asset('images/brands/bosch.png') }}">
            </a>

            <a class="btn d-flex bg-light mx-1 flex-fill rounded-3" href="/browseItem">
                <img class="img-fluid mx-auto my-auto" src="{{ secure_asset('images/brands/makita.png') }}">
            </a>

            <a class="btn d-flex bg-light mx-1 flex-fill rounded-3" href="/browseItem">
                <img class="img-fluid mx-auto my-auto" src="{{ secure_asset('images/brands/milwaukee.png') }}">
            </a>

            <a class="btn d-flex bg-light flex-fill mx-1 rounded-3" href="/browseItem">
                <img class="img-fluid mx-auto my-auto" src="{{ secure_asset('images/brands/tigaRoda.png') }}">
            </a>
        </div>
    </div>


    <div class="d-flex flex-column w-100">
        <p class="fs-3 my-auto ms-3 me-auto text-light">
            New Items
        </p>
        <hr class="bg-light my-0 mx-3 hr-custom">

        <div class="d-flex gap-3 my-3">
            
            

        </div>        

    </div>



</x-layout>