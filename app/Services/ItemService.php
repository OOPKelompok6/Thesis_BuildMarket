<?php

namespace App\Services;


use App\Models\Brand;
use App\Models\Item;

class ItemService
{

    public function getBrands()
    {
        return Brand::all();
    }

    public function getNewProducts()
    {
        return Item::with('category')->latest()->take(9)->get();
    }
}
