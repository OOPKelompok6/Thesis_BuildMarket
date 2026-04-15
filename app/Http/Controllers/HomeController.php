<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ItemService;

class HomeController extends Controller
{
    //

    public function __construct(protected ItemService $itemService)
    {}

    public function index()
    {
        $brands = $this->itemService->getBrands();
        $newProducts = $this->itemService->getNewProducts();

        return view('home', compact('brands', 'newProducts'));
    }
}
