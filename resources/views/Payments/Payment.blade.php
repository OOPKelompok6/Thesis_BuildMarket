<x-layout>
    <div class="d-flex flex-column w-100 min-vh-100 align-items-center">
        <div class="d-flex w-50 flex-column bg-light mx-auto my-auto rounded-5">
            <div style="height: 3.5rem" class="bg-dark p-0 m-0 w-100 rounded-top-5"></div>

            <div class="d-flex mt-3 flex-row w-75 mx-auto mb-4">
                <div class="d-flex flex-column me-auto">
                    <p class="mb-0 fs-5 fw-bold">{{ $user->firstName }} {{ $user->lastName }}</p>
                    <p class="text-secondary">{{ $user->email }}</p>
                </div>
                @canany(['isUser', 'isSeller', 'delete'])
                    <div class="d-flex ms-auto">
                        <x-generalButton buttonType="a" href="/newPayment" 
                            class="btn-dark text-light my-auto" message="New">
                        </x-generalButton>
                    </div>
                @endcanany
            </div>
            @if(count($payments) == 0)
                <p class="fs-3 text-dark my-auto mx-auto mb-5">Empty Payment</p>
            @else
                <div id="carouselExample" class="carousel carousel-dark slide">
                    <div class="carousel-inner">
                         @foreach ($payments as $payment)
                            <div class="carousel-item @if($loop->first) active @endif">
                                <x-informationCardField class="mt-5 mb-5">
                                    <x-slot name="leftSide">
                                        <x-informationCardInfo title="Card Vendor" name="{{ $payment->vendor }}">
                                        </x-informationCardInfo>
                                        <x-informationCardInfo title="Expiration Date" name="{{ (new DateTime($payment->expiration_Date))->format('Y-m-d') }}">
                                        </x-informationCardInfo>
                                    </x-slot>
                                    <x-slot name="rightSide">
                                        <x-informationCardInfo title="Card Number" name="{{ $payment->cardNumber }}">
                                        </x-informationCardInfo>
                                        <x-informationCardInfo title="Billing Address" name="{{ $payment->billingAddress }}">
                                        </x-informationCardInfo>
                                    </x-slot>

                                    <x-slot name="bottomSide">
                                        <div class="d-flex flex-row w-100 my-2 gap-3 pe-5">
                                            <button form="delete-form-{{ $payment->id }}" class="ms-auto text-light bg-danger rounded-3">Delete</button>
                                            <a style="text-decoration: none;" href="editPayment/{{ $payment->id }}" class="text-light bg-primary rounded-3 me-5 aling-items-center"><span class="mx-3">Edit</span></a>
                                        </div>
                                    </x-slot>
                                </x-informationCardField>

                                <form id="delete-form-{{ $payment->id }}" class="hidden" method="POST" action="/payments/{{ $payment->id }}">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </div>
                        @endforeach
                    </div>
                    <button class="carousel-control-prev text-dark" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            @endif

        </div>
    </div>
</x-layout>