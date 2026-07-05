<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\ItemService;
use App\Services\ShipmentService;

class ShipmentController extends Controller
{
    public function __construct(protected ShipmentService $shipmentService)
    {}

    public function getAvailableProvince()
    {
        return response()->json($this->shipmentService->getAvailableProvince(), 200);
    }
    
    public function getAvailableCity()
    {
        return response()->json($this->shipmentService->getAvailableCity(), 200);
    }

    public function getAvailableDistrict()
    {
        return response()->json($this->shipmentService->getAvailableDistrict(), 200);
    }

    public function getShippingCost()
    {
        return response()->json($this->shipmentService->getShippingCost(), 200);
    }
}
