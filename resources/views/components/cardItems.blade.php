@props(['category', 'messageLink', 'messageText'])

<div class="card mb-3" style="max-width: 380px;">
    <div class="row g-0 my-2 ms-2">
        <div class="col-md-4">
            @if ('category' == 'Flooring')
                <img src="{{ secure_asset('images/cards/flooring.png') }}" class="img-fluid rounded-start"/>
            @elseif ('category' == 'Plumbing')
                <img src="{{ secure_asset('images/cards/plumbing.png') }}" class="img-fluid rounded-start"/>
            @elseif ('category' == 'Tools & Hardware')
                <img src="{{ secure_asset('images/cards/tools.png') }}" class="img-fluid rounded-start"/>
            @elseif ('category' == 'Cement')
                <img src="{{ secure_asset('images/cards/cement.png') }}" class="img-fluid rounded-start"/>
            @else
                <img src="{{ secure_asset('images/cards/bathroom.png') }}" class="img-fluid rounded-start"/>
            @endif
        </div>
        <div class="col-md-8">
            <div class="card-body">
                <div class="d-flex flex-row gap-5 mb-1">
                    <span class="font-xSmall">{{ $category }}</span>
                    <span class="font-xSmall">{{ $brand }}</span>
                </div>
                <h5 class="card-title">{{ $name }}</h5>
                <div class="card-text">
                    <p class="d-flex my-0">Price: {{ $price }}</p>
                    <p class="d-flex mt-0 my-2">Quantity: {{ $quantity }}</p>

                    <div class="d-flex mb-1 flex-row">
                        <a>View Item</a>
                        <a class="ms-auto">Edit Item</a>
                    </div>
                    <a>Delete Item</a>
                </div>
            </div>
        </div>
    </div>
</div>