<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\ItemService;

class ItemController extends Controller
{
    public function __construct(protected ItemService $itemService)
    {}

    public function getItems()
    {
        return response()->json($this->itemService->getItems(request()->query()), 200);
    }

    public function getOwnItems()
    {
        return response()->json($this->itemService->getOwnItems(request()->query()), 200);
    }
}
