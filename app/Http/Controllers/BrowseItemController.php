<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ItemService;

class BrowseItemController extends Controller
{
    //

    public function __construct(protected ItemService $itemService)
    {}

    public function browseItem()
    {
        return view('browseItem', ['categories' => $this->itemService->getCategories(), 'brands' => $this->itemService->getBrands()]);
    }
}
