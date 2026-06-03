<?php

namespace App\Services;


use App\Models\Brand;
use App\Models\Cart_item;
use App\Models\Category;
use App\Models\Item;
use Illuminate\Support\Facades\Auth;

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
        return Item::with('category', 'brand')->where('isActive', '=', 1)->where('quantity', '!=', 0)->latest()->take(9)->get();
    }

    public function getItems($params)
    {
        $query = Item::query();

        $query->where('isActive', '=', 1);
        if(Auth::user()?->role != 'Admin') {
            $query->where('quantity', '>', 0);
        }

        if(($params["emptyStock"] ?? null) && (Auth::user()->role == 'Admin')) {
            $query->where('quantity', 0);
        }

        if($params["name"] ?? null) {
            $query->where('name', 'like', '%' . $params["name"] . '%');
        }

        if($params["sellerName"] ?? null) {
            $query->whereHas('user', function ($query) use ($params) {
                $query->where('firstName', 'like', '%' . $params["sellerName"] . '%')
                ->orWhere('lastName', 'like', '%' . $params["sellerName"] . '%');
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

        return $query->with('brand', 'category')->paginate(10)->withQueryString();
    }

    public function deleteItem($item) {
        Cart_item::where('item_id', $item->id)->delete();
        $item->isActive = false;
        $item->save();
    }

    public function createItem($item) {
        Item::create([
            'name' => $item['name'],
            'brand_id' => $item['brand'],
            'isActive' => true,
            'category_id' => $item['category'],
            'price' => $item['price'],
            'quantity' => $item['quantity'],
            'description' => $item['description'],
            'user_id' => Auth::user()->id
        ]);
    }

    public function updateItem($item, $item_newParams) {
        $item->name = $item_newParams['name'];
        $item->brand_id = $item_newParams['brand'];
        $item->category_id = $item_newParams['category'];
        $item->price = $item_newParams['price'];
        $item->quantity = $item_newParams['quantity'];
        $item->description = $item_newParams['description'];
        $item->save();
    }

    public function getOwnItems($params)
    {
        $query = Item::query();
        $query->where('user_id', '=', Auth::user()->id);

        $query->where('isActive', '=', 1);

        if($params["name"] ?? null) {
            $query->where('name', 'like', '%' . $params["name"] . '%');
        }

        if($params["emptyStock"] ?? null) {
            $query->where('quantity', 0);
        }

        if($params["sellerName"] ?? null) {
            $query->whereHas('user', function ($query) use ($params) {
                $query->where('firstName', 'like', '%' . $params["sellerName"] . '%')
                ->orWhere('lastName', 'like', '%' . $params["sellerName"] . '%');
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


    public function getSimilarItems($item)
    {
        return Item::with('category', 'brand')
            ->where('category_id', $item->category_id)
            ->where('isActive', '=', 1)
            ->where('id', '!=', $item->id)
            ->where('quantity', '!=', 0)
            ->latest()
            ->take(6)
            ->get();
    }

    public function updateItemStock($payload)
    {
        $items = Item::whereIn('id', $payload['indexes'])->get()->keyBy('id');

        foreach($payload['indexes'] as $index => $item_id) {
            $item =  $items[$item_id] ?? null;

            if (!$item) {
                continue;
            }


            $item->quantity = $item->quantity - $payload['quantities'][$index];
            $item->save();
        }
    }
}
