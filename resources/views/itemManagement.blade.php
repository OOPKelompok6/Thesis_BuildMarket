@props(['categories', 'brands'])

<x-layout :customScript="[secure_asset('js/itemManagement.js')]" deffered="true">
    <div class="d-flex flex-row gap-5 w-100">
        <div class="d-flex flex-column w-25">
            <div class="bg-light rounded-3 mx-3 my-5 w-100">
                <p class="text-dark fs-4 fw-bold ms-2 my-2">Filter items</p>
                <div id="itemFilterForm" class="my-4 d-flex flex-column">
                    <div class="mb-3 mx-2">
                        <label for="itemNameInput" class="form-label">Item name</label>
                        <input type="text" class="form-control" id="itemNameInput" aria-describedby="itemInput">
                    </div>

                    @can('isAdmin')
                        <div class="mb-3 mx-2">
                            <label for="itemNameInput" class="form-label">Seller name</label>
                            <input type="text" class="form-control" id="sellerNameInput" aria-describedby="itemInput">
                        </div>
                    @endcan

                    <div class="mb-3 mx-2">
                        <label for="categorySelect" class="form-label">Category</label>
                        <select id="categorySelect" class="form-select">
                            <option value="">None</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->name }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3 mx-2">
                        <label for="brandSelect" class="form-label">Brand</label>
                        <select id="brandSelect" class="form-select">
                            <option value="">None</option>
                            @foreach ($brands as $brand)
                                <option value="{{ $brand->name }}">{{ $brand->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3 mx-2">
                        <label for="orderingSelect" class="form-label">Order By</label>
                        <select id="orderingSelect" class="form-select">
                            <option value="">None</option>
                            <option value="created_date-newest">Newest</option>
                            <option value="created_date-oldest">Oldest</option>
                            <option value="price-asc">Price Ascending</option>
                            <option value="price-desc">Price Descending</option>
                        </select>
                    </div>

                    <div class="d-flex flex-row my-3">
                        @can('isSeller')
                            <a href="/newItem" id="newItemButton" class="ms-2 me-auto btn btn-primary">New Item</a>
                        @endcan
                        <button id="submitSearch" type="button" class="ms-auto me-2 btn btn-primary">Submit</button>
                    </div>
                </div>
            </div>
        </div>

        <div id="itemPlace" class="mx-3 my-5 d-flex flex-column w-75">
            
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModal" aria-hidden="true">
        <form id="deleteForm" class="d-none" method="POST">@csrf @method('DELETE')</form>
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="deleteModalLabel">Confirm Deletion</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete this item?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Cancel</button>
                <button form="deleteForm" type="submit" class="btn btn-danger">Delete</button>
            </div>
            </div>
        </div>
    </div>
</x-layout>