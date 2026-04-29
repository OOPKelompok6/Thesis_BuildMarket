<?php

namespace App\Services;

use App\Models\Cart_item;
use Illuminate\Support\Facades\Auth;

class CartService
{
    public function getCartItems()
    {
        return Cart_item::with('item')->where('user_id', Auth::user()->id)->get();
    }

    public function addToCart($payload)
    {
        Cart_item::create([
            'user_id' => Auth::user()->id,
            'item_id' => $payload['itemId'],
            'quantity' => $payload['quantity']
        ]);
    }

    public function updateCart($payload)
    {
        $cartItem = Cart_item::where('user_id', Auth::user()->id)
            ->where('item_id', $payload['itemId'])
            ->first();

        $cartItem->quantity = $payload['quantity'];
        $cartItem->save();
    }

    public function deleteCartItem($cartItem)
    {
        $cartItem->delete();
    }
}