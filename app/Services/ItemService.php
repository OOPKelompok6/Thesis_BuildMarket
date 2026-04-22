<?php

namespace App\Services;


use App\Models\Brand;
use App\Models\Category;
use App\Models\Item;

class ItemService
{

    public function getBrands()
    {
        return Brand::all();
    }

    public function getCategories()
    {
        return Category::all();
    }

    public function getNewProducts()
    {
        return Item::with('category', 'brand')->where('quantity', '!=', 0)->latest()->take(9)->get();
    }

    public function getItems($params)
    {
        $query = Item::query();
        $query->where('quantity', '!=', 0);

        if($params["name"] ?? null) {
            $query->where('name', 'like', '%' . $params["name"] . '%');
        }

        if($params["sellerName"] ?? null) {
            $query->whereHas('user', function ($query) use ($params) {
                $query->where('name', 'like', '%' . $params["sellerName"] . '%');
            });
        }

        if($params["category"] ?? null) {
            $query->whereHas('category', function ($query) use ($params) {
                $query->where('name', 'like', '%' . $params["category"] . '%');
            });
        }

        if($params["brand"] ?? null) {
            $query->whereHas('brand', function ($query) use ($params) {
                $query->where('name', 'like', '%' . $params["brand"] . '%');
            });
        }

        if($params["ordering"] ?? null) {
            if($params["ordering"] == "created_date-newest") {
                $query->orderBy("created_at", "desc");
            }
            else if($params["ordering"] == "created_date-oldest") {
                $query->orderBy("created_at", "asc");
            }
            else if($params["ordering"] == "price-asc") {
                $query->orderBy("price", "asc");
            }   
            else if($params["ordering"] == "price-desc") {
                $query->orderBy("price", "desc");
            }
        }

        return $query->with('brand', 'category')->paginate(10)->withQueryString();;
    }
}
