<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\ItemService;
use App\Services\ShipmentService;

class ItemController extends Controller
{
    public function __construct(protected ShipmentService $shipmentService)
    {}

    public function getAvailableProvince()
    {
        return response()->json($this->shipmentService->getAvailableProvince(), 200);
    }
}
