<?php

namespace App\Services;

use App\Models\Item;
use App\Models\Transaction_detail;
use App\Models\Transaction_header;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;

class TransactionService
{
    public function createTransaction($payload)
    {
        $header = Transaction_header::create([
            'user_id' => $payload['user_id'],
            'payment_id' => $payload['payment_id'] ?? null
        ]);

        foreach($payload['indexes'] as $index => $item_id) {
            Transaction_detail::create([
                'transaction_header_id' => $header->id,
                'item_id' => $item_id,
                'quantity' => $payload['quantities'][$index]
            ]);
        }
    }

    public function getTransactions() {
        return DB::table('transaction_headers as th')
                        ->join('transaction_details as td', 'td.transaction_header_id', '=', 'th.id')
                        ->join('items as i', 'i.id', '=', 'td.item_id') 
                        ->join('payments as p', 'p.id', '=', 'th.payment_id')
                        ->select('th.*', 'p.vendor', DB::raw('SUM(td.quantity * i.price) as total')) 
                        ->where('th.user_id', Auth::user()->id)
                        ->groupBy('th.id', 'th.user_id', 'p.vendor', 'th.payment_id', 'th.created_at', 'th.updated_at')
                        ->paginate(15);
    }

    public function getTotalPrice($id)
    {
        $items = Transaction_detail::with('item')->where('transaction_header_id', $id)->get();
        $total = 0;

        foreach($items as $item) {
            $total += $item->item->price * $item->quantity;
        }

        return $total;
    }

    public function getTransactionItems($id)
    {
        return Transaction_detail::with('item')->where('transaction_header_id', $id)->paginate(20);
    }

    public function createOtherTransactionMethod($payload)
    {   

        //Process payload into final payload
        $finPayload = [];

        //process customer
        $customer = [];
        $customer['first_name'] = Auth::user()->firstName;
        $customer['last_name'] = Auth::user()->lastName;
        $customer['email'] = Auth::user()->email;
        $customer['phone'] = '+62181000000000';
        $customer['notes'] = 'Thank you for your purchase. Please follow the instructions to pay.';

        $finPayload['customer_details'] = $customer;

        //item Detail processing
        $itemDetail = [];
        $grossTotal = 0;

        foreach($payload['indexes'] as $index => $itemId) {
            $itemObj = [];
            $item = Item::find($itemId);

            $itemObj['id'] = (string)$item->id;
            $itemObj['name'] = $item->name;
            $itemObj['price'] = $item->price;
            $itemObj['quantity'] = $payload['quantities'][$index];
            $itemObj['brand'] = $item->brand->name;
            $itemObj['category'] = $item->category->name;

            $grossTotal +=  $payload['quantities'][$index] * $item->price;

            $itemDetail[] = $itemObj;
        }

        $finPayload['item_details'] = $itemDetail;

        //transaction details processing
        $tDetails = [];
        $tDetails['order_id'] = (string)Auth::user()->id;
        $tDetails['gross_amount'] = $grossTotal;

        $finPayload['transaction_details'] = $tDetails;

        //Expiry processing
        $expiry = [
            'start_time' => now()
                ->setTimezone('Asia/Jakarta')
                ->format('Y-m-d H:i O'),

            'duration' => 1,
            'unit' => 'days',
        ];

        $finPayload['expiry'] = $expiry;

        //Other details
        $finPayload['customer_required'] = true;
        $finPayload['usage_limit'] = 1;
        $finPayload['enabled_payments'] = [
            "gopay",
            "akulaku",
            "qris",
            "alfamart",
            "indomaret"
        ];

        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
            'X-Override-Notification' => url('/api/payments/webHookHandler'),
            'Authorization' => 'Basic ' . base64_encode(env('MIDTRANS_SERVER_KEY') . ':')
        ])->post('https://api.sandbox.midtrans.com/v1/payment-links', $finPayload);

        // Check if request was successful
        if ($response->successful()) {
            $url = $response->object()->payment_url;
            return $url;
        }
        else {
            return '/';
        }
    }
}