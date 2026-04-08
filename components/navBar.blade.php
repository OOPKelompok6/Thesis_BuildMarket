<nav class="navbar" style="background-color: #141414;">

    <div class="d-flex flex-row w-100">
        @auth
            <div class="d-flex ms-2 align-items-center">
                <a data-bs-toggle="offcanvas" href="#sideBar" role="button" aria-controls="sideBar">
                    <i class="bi bi-list text-light fs-6"></i>
                </a>
            </div>
        @endauth

        <div class="d-flex ms-2 me-5 align-items-center">
            <a href="/" style="text-decoration:none;" class="text-light fs-6 fw-bold" href="#sideBar" type="button">
                BuildMarket
            </a>
        </div>

        <form class="d-flex mx-auto input-group ms-4 me-5 w-50">
            {{-- Dont forget to redirect to category here --}}
            <input type="text" style="background-color: #141414; " class="text-light form-control search-input">
            <button type="submit" class="input-group-text" style="background-color: #141414; id="searchBar">
                <i class="bi bi-search text-light"></i>
            </button>
        </form>

        <div class="d-flex mx-3 align-items-center">
            <a href="/" style="text-decoration:none;" class="text-light fs-6 fw-normal" href="#sideBar" type="button">
                Category
            </a>
        </div>

        @auth
            @canany(['isUser', 'isSeller'])
                <div class="d-flex mx-5 align-items-center">
                    <a href="/" style="text-decoration:none;" class="text-light fs-6 fw-normal" href="#sideBar" type="button">
                        Cart
                    </a>
                </div>
            @endcanany
                <form class="ms-auto" method="POST" action="/logout">
                        @csrf
                        <div class="d-flex mx-1">
                            <button type="submit" class="btn btn-secondary rounded-pill" >
                                <span class="text-light fs-6 fw-normal">Log Out</span>
                            </button>
                        </div>
                </form>
        @endauth

        @guest
            <div class="d-flex ms-auto mx-1">
                <a href="/register" type="button" class="btn btn-secondary rounded-pill" >
                    <span class="text-light fs-6 fw-normal">Register</span>
                </a>
            </div>
        @endguest

    </div>
  
</nav>