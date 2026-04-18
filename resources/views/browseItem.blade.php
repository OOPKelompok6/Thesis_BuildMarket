@props(['categories', 'brands'])

<x-layout :customScript="[secure_asset('js/browseItem.js')]" deffered="true">
    <div class="d-flex flex-row gap-5 w-100">
        <div class="d-flex flex-column w-25">
            <div class="bg-light rounded-3 mx-3 my-5 w-100">
                <p class="text-dark fs-4 fw-bold ms-2 my-2">Filter items</p>
                <div id="itemFilterForm" class="my-4 d-flex flex-column">
                    <div class="mb-3 mx-2">
                        <label for="itemNameInput" class="form-label">Item name</label>
                        <input type="text" class="form-control" id="itemNameInput" aria-describedby="itemInput">
                    </div>

                    <div class="mb-3 mx-2">
                        <label for="itemNameInput" class="form-label">Seller name</label>
                        <input type="text" class="form-control" id="sellerNameInput" aria-describedby="itemInput">
                    </div>

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

                    <div class="my-3 ms-auto me-2">
                        <button id="submitSearch" type="button" class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </div>
        </div>

        <div id="itemPlace" class="mx-3 my-5 d-flex flex-column w-75">
            
        </div>
    </div>
</x-layout>