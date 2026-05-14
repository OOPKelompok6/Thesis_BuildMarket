<?php

namespace App\Http\Controllers;
use App\Models\Cart_item;
use Illuminate\Http\Request;
use App\Services\CartService;
use App\Services\ItemService;
use App\Services\PaymentService;
use App\Services\TransactionService;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    //
     public function __construct(protected CartService $cartService, protected ItemService $itemService,
        protected PaymentService $paymentService, protected TransactionService $transactionService)
        {}
 
    public function cart()
    {
        return view('Cart.cart', 
            ['cartItems' => $this->cartService->getCartItems(), 
            'totalPrice' => $this->cartService->getTotalPrice(),
            'payments' => $this->paymentService->getPayments(Auth::user())]);
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
 
    public function updateCart(Cart_item $cartItem)
    {
        $this->cartService->updateCart($cartItem, request()->input('quantity'));
        return redirect('/cart');
    }
 
    public function deleteCartItem(Cart_item $cartItem)
    {
        $this->cartService->deleteCartItem($cartItem);
        return redirect('/cart');
    }

    public function buyItems()
    {
        request()->validate([
            'payment_id' => 'required'
        ]);
    
        $payload = request()->only(['payment_id', 'quantities', 'indexes']);
        $payload['user_id'] = Auth::user()->id;

        $this->transactionService->createTransaction($payload);
        $this->itemService->updateItemStock($payload);
        $this->cartService->clearCartItem($payload['user_id']);
        return redirect('/cart');
    }

    public function buyItemsOtherMethods() {
        $payload = request()->only(['quantities', 'indexes']);
        $qrisURL = $this->transactionService->createOtherTransactionMethod($payload);
        return redirect($qrisURL);
    }
}
