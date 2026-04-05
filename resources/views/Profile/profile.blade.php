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
                        <x-generalButton buttonType="a" href="/editProfile" 
                            class="btn-dark text-light my-auto" message="Edit">
                        </x-generalButton>
                    </div>
                @endcanany
            </div>
            <x-informationCardField class="mt-5 mb-5">
                <x-slot name="leftSide">
                    <x-informationCardInfo title="First name" name="{{ $user->firstName }}">
                    </x-informationCardInfo>
                    <x-informationCardInfo title="Email" name="{{ $user->email }}">
                    </x-informationCardInfo>
                </x-slot>
                <x-slot name="rightSide">
                    <x-informationCardInfo title="Last name" name="{{ $user->lastName }}">
                    </x-informationCardInfo>
                    <x-informationCardInfo title="Role" name="{{ $user->role }}">
                    </x-informationCardInfo>
                </x-slot>
            </x-informationCardField>

        </div>
    </div>
</x-layout>