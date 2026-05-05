<?php

namespace App\Http\Controllers;

use App\Models\Transaction_header;
use App\Services\TransactionService;
use Illuminate\Support\Facades\Gate;

class TransactionController extends Controller
{

    public function __construct(protected TransactionService $transactionService)
    {}

    public function transactions() {
        if (Gate::allows('isUser') || Gate::allows('isSeller')){
            return view('transactions.transactionList', ['transactions' => $this->transactionService->getTransactions()]);
        } else {
            abort(403);
        }
    }

    public function transactionDetails(Transaction_header $transactionHeader) {
        if (Gate::allows('isUser') || Gate::allows('isSeller')){
            return view('transactions.transactionDetail', 
                ['payment' => $transactionHeader->payment,
                 'totalPrice' => $this->transactionService->getTotalPrice($transactionHeader->id),
                 'transactionItems' => $this->transactionService->getTransactionItems($transactionHeader->id)
                ]);
        } else {
            abort(403);
        }
    }
}
