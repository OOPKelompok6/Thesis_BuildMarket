<x-headLayout>
    <div style="background-color: #141414;" class="d-flex flex-column min-vh-100 max-vw-100">
        <x-navBar></x-navBar>
        @auth
            <x-sideBar></x-sideBar>
        @endauth
        {{-- Content of pages here --}}
        {{ $slot }} 
        <x-footer></x-footer>
    </div>
</x-headLayout>