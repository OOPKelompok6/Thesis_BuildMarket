<?php

namespace App\Services;

use App\Models\Transaction_detail;
use App\Models\Transaction_header;
use Illuminate\Support\Facades\Auth;

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
}