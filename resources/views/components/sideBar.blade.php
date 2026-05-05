<div class="offcanvas offcanvas-start offcanvas-custom-width" data-bs-theme="dark" data-bs-scroll="true" tabindex="-1" id="sideBar" aria-labelledby="offcanvasLabel">
  <div class="offcanvas-header">
    <a type="button" class="mx-auto" data-bs-dismiss="offcanvas" aria-label="Close">
        <i class="bi bi-list text-light fs-5"></i>
    </a>
  </div>
  <div class="offcanvas-body">
        <div class="d-flex align-items-center my-3">
            <a href="/profile" style="text-decoration:none;" class="text-light" type="button">
                <i class="bi bi-person"></i>
            </a>
        </div>    

        @canany(['isUser', 'isSeller'])

            <div class="d-flex align-items-center my-3">
                <a href="/payments" style="text-decoration:none;" class="text-light" type="button">
                    <i class="bi bi-wallet"></i>
                </a>
            </div>
            @can('isSeller')
                <div class="d-flex align-items-center my-3">
                    <a href="/itemManagement" style="text-decoration:none;" class="text-light" type="button">
                        <i class="bi bi-boxes"></i>
                    </a>
                </div>
            @endcan

            <div class="d-flex align-items-center my-3">
                <a href="/transactions" style="text-decoration:none;" class="text-light" type="button">
                    <i class="bi bi-columns-gap"></i>
                </a>
            </div>
        @endcanany

        @can('isAdmin')
            <div class="d-flex align-items-center my-3">
                <a href="/itemManagement" style="text-decoration:none;" class="text-light" type="button">
                    <i class="bi bi-boxes"></i>
                </a>
            </div>
            
            <div class="d-flex align-items-center my-3">
                <a href="/approvalList" style="text-decoration:none;" class="text-light" type="button">
                    <i class="bi bi-envelope"></i>
                </a>
            </div>
        @endcan
  </div>
</div>