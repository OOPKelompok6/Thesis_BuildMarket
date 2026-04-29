<x-layout :customScript="[secure_asset('js/tinymce/tinymce.js')]" deffered="true">
    <form class="d-flex flex-column w-75 mx-auto my-5" method="POST" @if(request()->routeIs('editItem')) action="/updateItem/{{ $item->id }}" @else action="/newItem" @endif>
        @csrf

        <div class="mb-3">
            <label for="itemName" class="text-light form-label">Item name</label>
            <input @if(request()->routeIs('editItem')) value="{{ $item->name }}" @endif name="name" type="text" class="form-control" id="itemName">
        </div>

        <div class="d-flex flex-row gap-4 mb-3">
            <div class="d-flex flex-column flex-grow-1">
                <label for="categorySelect" class="form-label text-light">Category</label>
                <select id="categorySelect" name="category" class="form-select">
                    @foreach ($categories as $category)
                        <option
                            @if(request()->routeIs('editItem')) 
                                @if($item->category_id === $category->id)
                                    selected
                                @endif 
                            @endif 
                            value="{{ $category->id }}">{{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="d-flex flex-column flex-grow-1">
                <label for="brandSelect" class="form-label text-light">Brand</label>
                <select id="brandSelect" name="brand" class="form-select">
                    @foreach ($brands as $brand)
                        <option
                            @if(request()->routeIs('editItem')) 
                                @if($item->brand_id === $brand->id)
                                    selected
                                @endif 
                            @endif 
                            value="{{ $brand->id }}">{{ $brand->name }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="mb-3">
            <label for="quantityValue" class="text-light form-label">Quantity</label>
            <input @if(request()->routeIs('editItem')) value="{{ $item->quantity }}" @endif type="number" value="1" min="1" class="form-control" id="quantityValue" name="quantity">
        </div>

        <div class="mb-3">
            <label for="priceId" class="text-light form-label">Price</label>
            <input @if(request()->routeIs('editItem')) value="{{ $item->price }}" @endif type="number" min="1" value="1" class="form-control" id="priceId" name="price">
        </div>

        <div class="mb-3">
            <label for="descriptionTextArea" class="text-light form-label">Description</label>
            <textarea name="description" class="form-control" id="descriptionTextArea" rows="3">
                @if(request()->routeIs('editItem')) {{ $item->description }} @endif
            </textarea>
        </div>
        <script src="{{secure_asset('js/tinymce/tinymceConfig.js')}}"></script>

        <div class="d-flex flex-row flex-grow-1 ms-auto gap-3 mb-5 mt-2">
            <a href="/itemManagement" class="btn bg-danger text-light">Cancel</a>
            <button type="submit" class="btn bg-primary text-light">Submit</button>
        </div>
    </form>
</x-layout>