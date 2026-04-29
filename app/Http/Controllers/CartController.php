<?php

namespace App\Http\Controllers;
use App\Models\Cart_item;
use Illuminate\Http\Request;
use App\Services\CartService;
class CartController extends Controller
{
    //
     public function __construct(protected CartService $cartService)
    {}
 
    public function cart()
    {
        $cartItems = $this->cartService->getCartItems();
        return view('Cart.cart', ['cartItems' => $cartItems]);
    }
 
    public function addToCart()
    {
        $payload = request()->validate([
            'itemId' => 'required',
            'quantity' => 'required|integer|min:1'
        ]);
 
        $this->cartService->addToCart($payload);
        return redirect('/item/' . $payload['itemId']);
    }
 
    public function updateCart()
    {
        $payload = request()->validate([
            'itemId' => 'required',
            'quantity' => 'required|integer|min:1'
        ]);
 
        $this->cartService->updateCart($payload);
        return redirect('/item/' . $payload['itemId']);
    }
 
    public function deleteCartItem(Cart_item $cartItem)
    {
        $this->cartService->deleteCartItem($cartItem);
        return redirect('/cart');
    }
}
