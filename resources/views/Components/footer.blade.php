<div class="d-flex flex-column mt-auto w-100" style="background-color: #303030">
    <div class="d-flex flex-row mb-5">
        <div class="d-flex flex-column ms-3 mt-3 me-3">
            <p class="ms-1" style="color: #B3B3B3">Contact Us</p>
            <p class="text-light ms-1"><i class="bi bi-telephone"></i><span class="ms-2">1-800-41-424</span></p>
            <p class="text-light ms-1"><i class="bi bi-envelope"></i><span class="ms-2">Buildmarket@gmail.com</span></p>
        </div>

        @auth
            @can('isUser')
                <div class="d-flex flex-column ms-3 mt-3">
                    <p class="ms-1" style="color: #B3B3B3">Be a partner</p>
                    <a href="/sellerRequest" class="text-light ms-1" style="text-decoration:none;">Become a verified seller</a>
                </div>
            @endcan
        @endauth
    </div>

    <div class="d-flex flex-row">
        <p class="fs-6 text-light fw-bold ms-1 my-auto">BuildMarket - A marketplace, at any place</p>
    </div>
</div>