<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\HomeService;

class HomeController extends Controller
{
    //

    public function __construct(protected HomeService $homeService)
    {}

    public function index()
    {
        $brands = $this->homeService->getBrands();
        $newProducts = $this->homeService->getNewProducts();

        return view('home', compact('brands', 'newProducts'));
    }
}
