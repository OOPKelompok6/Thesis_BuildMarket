<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;
use App\Services\ItemService;
use Illuminate\Support\Facades\Gate;
use Mews\Purifier\Facades\Purifier;

class ItemManagementController extends Controller
{
    //

    public function __construct(protected ItemService $itemService)
    {}

    public function browseItem()
    {
        if (Gate::allows('isAdmin') || Gate::allows('isSeller')){
            return view('itemManagement', ['categories' => $this->itemService->getCategories(), 'brands' => $this->itemService->getBrands()]);
        } else {
            abort(403);
        }
    }

    public function deleteItem(Item $item)
    {
        $this->itemService->deleteItem($item);
        return redirect('/itemManagement');
    }

    public function newItem()
    {
        return view('newItem', ['categories' => $this->itemService->getCategories(), 'brands' => $this->itemService->getBrands()]);
    }

    public function createItem()
    {
        $item = request()->validate([
            'name' => ['required'],
            'brand' => ['required'],
            'category' => ['required'],
            'quantity' => ['required'],
            'price' => ['required'],
            'description' => ['required'],
        ]);
        $item['description'] = Purifier::clean($item['description']);
        $this->itemService->createItem($item);

        return redirect('/itemManagement');
    }

    public function updateItem(Item $item)
    {
        $item_newParams = request()->validate([
            'name' => ['required'],
            'brand' => ['required'],
            'category' => ['required'],
            'quantity' => ['required'],
            'price' => ['required'],
            'description' => ['required'],
        ]);
        $item_newParams['description'] = Purifier::clean($item_newParams['description']);
        $this->itemService->updateItem($item, $item_newParams);

        return redirect('/itemManagement');
    }

    public function editItem(Item $item)
    {
        return view('newItem', ['item'=> $item, 'categories' => $this->itemService->getCategories(), 'brands' => $this->itemService->getBrands()]);
    }
}
