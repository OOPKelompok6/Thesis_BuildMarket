<?php

namespace App\Services;

use App\Models\Cart_item;
use Illuminate\Support\Facades\Auth;

class CartService
{
    public function getCartItems()
    {
        return Cart_item::with('item')->where('user_id', Auth::user()->id)->paginate(10);
    }

    public function getTotalPrice()
    {
        $cartItems = Cart_item::with('item')->where('user_id', Auth::user()->id)->get();
        $total = 0;

        foreach($cartItems as $cartItem) {
            $total += $cartItem->item->price * $cartItem->quantity;
        }

        return $total;
    }

    public function addToCart($payload)
    {
        Cart_item::create([
            'user_id' => Auth::user()->id,
            'item_id' => $payload['itemId'],
            'quantity' => $payload['quantity']
        ]);
    }

    public function updateCart($cartItem, $quantity)
    {
        $cartItem->quantity = $quantity;
        $cartItem->save();
    }

    public function deleteCartItem($cartItem)
    {
        $cartItem->delete();
    }

    public function clearCartItem($payload)
    {
        $externalPaymentId = $payload['external_payment_id'] ?? null;
        if($externalPaymentId == null) {
            Cart_item::where('user_id', $payload['user_id'])->delete();
        }
        else {
            Cart_item::where('user_id', $payload['user_id'])
                ->where('external_payment_id', $externalPaymentId)->delete();
        }
    }

    public function addExternalPaymentId($payload) {
        $cart_items = Cart_item::where('user_id', $payload['user_id'])
            ->update(['external_Payment_id' => $payload['external_payment_id']]);
    }
}