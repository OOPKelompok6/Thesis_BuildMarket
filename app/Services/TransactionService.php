<?php

namespace App\Services;

use App\Models\Address;
use App\Models\Item;
use App\Models\Transaction_detail;
use App\Models\Transaction_header;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;

class TransactionService
{
    public function __construct(protected CartService $cartService){}

    public function createTransaction($payload) {
        $this->createTransactionDetail($payload, $this->createTransactionHeader($payload));
    }


    public function updateTransactionStatus($header) {
        $header->status = 'ACCEPTED';
        $header->save();
    }

    public function createTransactionDetail($payload, $header) {
        foreach($payload['indexes'] as $index => $item_id) {
            Transaction_detail::create([
                'transaction_header_id' => $header->id,
                'item_id' => $item_id,
                'quantity' => $payload['quantities'][$index]
            ]);
        }
    }

    public function createTransactionHeader($payload)
    {
        $header = Transaction_header::create([
            'user_id' => $payload['user_id'],
            'payment_id' => $payload['payment_id'],
            'external_payment_id' => $payload['external_payment_id'] ?? null,
            'status' => $payload['payment_status'] ?? 'ACCEPTED',
            'courier' => $payload['courier'],
            'province_id' => $payload['provinceId'],
            'city_id' => $payload['cityId'],
            'district_id' => $payload['districtId'],
            'total_price' => $payload['totalCost'],
            'shipping_cost' => $payload['shippingCostValue']
        ]);

        $address = $this->createAdress($header, $payload);
        $header->address_id = $address->id;
        $header->save();
        return $header;
    }

    public function createAdress($header, $payload) {
        return Address::create([
            'transaction_header_id' => $header->id,
            'province' => $payload['provinceValue'],
            'city' => $payload['cityValue'],
            'district' => $payload['districtValue']
        ]);
    }

    public function getTransactions() {
        return DB::table('transaction_headers as th')
                        ->join('transaction_details as td', 'td.transaction_header_id', '=', 'th.id')
                        ->join('items as i', 'i.id', '=', 'td.item_id') 
                        ->join('payments as p', 'p.id', '=', 'th.payment_id')
                        ->select('th.*', 'p.vendor', DB::raw('SUM(td.quantity * i.price) as total')) 
                        ->where('th.status', 'ACCEPTED')
                        ->where('th.user_id', Auth::user()->id)
                        ->groupBy('th.id', 
                            'th.user_id', 
                            'th.address_id',
                            'p.vendor', 
                            'th.payment_id', 
                            'th.created_at', 
                            'th.updated_at',
                            'courier',
                            'shipping_cost',
                            'total_price',
                            'province_id',
                            'city_id',
                            'district_id',
                            'status',
                            'external_payment_id')
                        ->paginate(15);
    }

    public function getSellerTotalItemData() {
        return DB::table('items as i')
                        ->join('transaction_details as td', 'td.item_id', '=', 'i.id')
                        ->select(DB::raw('COALESCE(SUM(IFNULL(td.quantity, 0)), 0) as totalItemSold'), DB::raw('COALESCE(SUM(IFNULL(td.quantity, 0) * i.price), 0) as totalSold')) 
                        ->where('i.user_id', Auth::user()->id)
                        ->first();
    }

    public function getEmptyStockData() {
        return Item::where('user_id', Auth::id())->where('isActive', true)->where('quantity', '=', 0)->count();
    }

    public function getTransactionItems($id)
    {
        return Transaction_detail::with('item')->where('transaction_header_id', $id)->paginate(20);
    }

    public function getTransactionHeader($payload)
    {
        return Transaction_header::where('user_id', $payload)
            ->where('external_payment_id', $payload['external_payment_id'])->first();
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
        $grossTotal = $payload['totalCost'] + $payload['shippingCostValue'];

        foreach($payload['indexes'] as $index => $itemId) {
            $itemObj = [];
            $item = Item::find($itemId);

            $itemObj['id'] = (string)$item->id;
            $itemObj['name'] = $item->name;
            $itemObj['price'] = $item->price;
            $itemObj['quantity'] = $payload['quantities'][$index];
            $itemObj['brand'] = $item->brand->name;
            $itemObj['category'] = $item->category->name;

            $itemDetail[] = $itemObj;
        }

        $itemObj = [];

        $itemObj['id'] = 0;
        $itemObj['name'] = 'Shipping Cost';
        $itemObj['price'] = $payload['shippingCostValue'];
        $itemObj['quantity'] = 1;
        $itemObj['brand'] = 'RajaOngkir';
        $itemObj['category'] = 'Shipping';

        $itemDetail[] = $itemObj;

        $finPayload['item_details'] = $itemDetail;

        //transaction details processing
        $tDetails = [];
        $tDetails['order_id'] = (string)Auth::user()->id . '-' . str()->random(5);
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

        $finPayload['callbacks'] = [
            'finish' => url('/cart'),
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
            $payload['external_payment_id'] = $response->object()->order_id;

            $this->createTransactionHeader($payload);
            $this->cartService->addExternalPaymentId($payload);

            return $url;
        }
        else {
            return '/';
        }
    }

    public function getSellerSalesData($startDate, $endDate) {

        $query = Transaction_detail::query();
        $query->with('transaction_header', 'item', 'transaction_header.payment');

        if($startDate) {
            $query->whereHas('transaction_header', function ($subQuery) use ($startDate) {
                $subQuery->where('created_at', '>=', $startDate);
            });
        }

        if($endDate) {
            $query->whereHas('transaction_header', function ($subQuery) use ($endDate) {
                $subQuery->where('created_at', '<=', $endDate . ' 23:59:59');
            });
        }

        return $query->whereHas('item', function ($subQuery) {
                $subQuery->where('user_id', Auth::id());
            })->paginate(15);
    }
}