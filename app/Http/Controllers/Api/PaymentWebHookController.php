<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Cart_item;
use App\Services\CartService;
use App\Services\ItemService;
use App\Services\TransactionService;

class PaymentWebHookController extends Controller
{
    public function __construct(protected TransactionService $transactionService, 
        protected ItemService $itemService, protected CartService $cartService)
    {}


    public function handle() {

        $signatureKey = hash(
            'sha512',
            request()->order_id .
            request()->status_code .
            request()->gross_amount .
            env('MIDTRANS_SERVER_KEY')
        );

        if ($signatureKey !== request()->signature_key) {
            return response()->json([
                'message' => 'Invalid signature'
            ], 401);
        }

         if (!in_array(request()->transaction_status, ['settlement', 'capture'])) {
            return response()->json([
                'message' => 'Ignoring non-success transaction'
            ], 200);
        }

        $user_id = request()->input('order_id');
        $order_id = request()->input('order_id');
        $user_id = substr($user_id, 0, strpos($user_id, '-')); 
        $order_id = substr($order_id, 0, strpos($order_id, '-', 4)); 

        $payload = $this->recreatePayload($user_id, $order_id);
        $header = $this->transactionService->getTransactionHeader($payload);

        if($header) {
            $this->transactionService->updateTransactionStatus($header);
            $this->transactionService->createTransactionDetail($payload, $header);
            $this->itemService->updateItemStock($payload);
            $this->cartService->clearCartItem($payload);

            return response()->json([
                'message' => 'Succesfully handled payment'
            ], 200);
        }

        return response()->json([
                'message' => 'Payment not found'
        ], 404);
    }

    private function recreatePayload($user_id, $order_id) {
        $payload = [];
        
        $payload['user_id'] = $user_id;
        $payload['external_payment_id'] = $order_id;

        $indexes = [];
        $quantities = [];

        $cart_items = Cart_item::where('user_id', $user_id)
            ->where('external_payment_id', $order_id)->get();

        foreach($cart_items as $cart_item) {
            $indexes[] = $cart_item->item_id;
            $quantities[] = $cart_item->quantity;
        }

        $payload['indexes'] = $indexes;
        $payload['quantities'] = $quantities;

        return $payload;
    }
}
