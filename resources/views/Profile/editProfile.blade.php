<x-layout>
    <div class="d-flex flex-column w-100 min-vh-100 align-items-center">
        <div class="d-flex w-50 flex-column bg-light mx-auto my-auto rounded-5">
                <div style="height: 3.5rem" class="bg-dark p-0 m-0 w-100 rounded-top-5"></div>

                <div class="d-flex mt-5 flex-row w-75 mx-auto mb-4">
                    <div class="d-flex flex-column me-auto">
                        <p class="mb-0 fs-5 fw-bold">{{ $user->firstName }} {{ $user->lastName }}</p>
                        <p class="text-secondary">{{ $user->email }}</p>
                    </div>
                </div>
                <form class="d-flex flex-column" method="POST" action="/profile">
                    @csrf

                    <x-informationCardField class="mt-3 mb-2">
                        <x-slot name="leftSide">
                            <x-informationCardInput
                                label="First name" placeholder="{{ $user->firstName }}" inputType="text" varName="firstName">
                            </x-informationCardInput>
                            <x-informationCardInput
                                label="Email" placeholder="{{ $user->email }}" inputType="email" varName="email">
                            </x-informationCardInput>
                        </x-slot>
                        <x-slot name="rightSide">
                            <x-informationCardInput
                                label="Last name" placeholder="{{ $user->lastName }}" inputType="text" varName="lastName">
                            </x-informationCardInput>
                            <x-informationCardInfo class="mt-2" title="Role" name="{{ $user->role }}">
                            </x-informationCardInfo>
                        </x-slot>
                    </x-informationCardField>

                    <div class="d-flex my-3 me-3 gap-3 flex-row ms-auto">
                        <x-generalButton buttonType="a" href="/profile" 
                            class="btn-danger text-light my-auto" message="Cancel">
                        </x-generalButton>
                        <x-generalButton buttonType="button" type="submit" 
                            class="btn-primary text-light my-auto" message="Submit">
                        </x-generalButton>
                    </div>
                </form>

        </div>
    </div>
</x-layout>