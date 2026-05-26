<?php

namespace App\Services;
use Illuminate\Support\Facades\Http;

class ShipmentService
{
    public function getAvailableProvince()
    {
        $response = Http::withHeaders([
            'Key' => env('RAJAONGKIR_KEY')
        ])->get('https://rajaongkir.komerce.id/api/v1/destination/province');

        if ($response->successful()) {
            return [
                'success' => true,
                'data' => $response->json()
            ];
        }

        return [
            'success' => false,
            'status' => $response->status(),
            'message' => $response->body()
        ];
    }

    public function getAvailableCity()
    {
        $response = Http::withHeaders([
            'Key' => env('RAJAONGKIR_KEY')
        ])->get('https://rajaongkir.komerce.id/api/v1/destination/city/' . request('provinceId'));

        if ($response->successful()) {
            return [
                'success' => true,
                'data' => $response->json()
            ];
        }

        return [
            'success' => false,
            'status' => $response->status(),
            'message' => $response->body()
        ];
    }

    public function getAvailableDistrict()
    {
        $response = Http::withHeaders([
            'Key' => env('RAJAONGKIR_KEY')
        ])->get('https://rajaongkir.komerce.id/api/v1/destination/district/' . request('cityId'));

        if ($response->successful()) {
            return [
                'success' => true,
                'data' => $response->json()
            ];
        }

        return [
            'success' => false,
            'status' => $response->status(),
            'message' => $response->body()
        ];
    }

    public function getShippingCost()
    {
        $response = Http::withHeaders([
            'Key' => env('RAJAONGKIR_KEY'),
            'Content-type' => 'application/x-www-form-urlencoded'
        ])->asForm()->post('https://rajaongkir.komerce.id/api/v1/calculate/district/domestic-cost', [
            'origin' => 1341,
            'destination' => request('destinationId'),
            'weight' => 30,
            'courier' => request('courierValue'),
            'price' => 'lowest'
        ]);

        if ($response->successful()) {
            return [
                'success' => true,
                'data' => $response->json()
            ];
        }

        return [
            'success' => false,
            'status' => $response->status(),
            'message' => $response->body()
        ];
    }
}
