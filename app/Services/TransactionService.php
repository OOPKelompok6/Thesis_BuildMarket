<?php

namespace App\Services;

use App\Models\Transaction_detail;
use App\Models\Transaction_header;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TransactionService
{
    public function createTransaction($payload)
    {
        $header = Transaction_header::create([
            'user_id' => Auth::user()->id,
            'payment_id' => $payload['payment_id']
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
}