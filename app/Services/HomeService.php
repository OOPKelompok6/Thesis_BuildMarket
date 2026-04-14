<?php

namespace App\Services;


use App\Models\Brand;
use App\Models\Item;

class HomeService
{

    public function getBrands()
    {
        return Brand::all();
    }

    public function getNewProducts()
    {
        return Item::latest()->take(9)->get();
    }
}
