<?php

namespace App\Exports;

use App\Models\Transaction_detail;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\FromView;

class SellerHistoryExport implements FromView
{
    public function __construct(protected $startDate, protected $endDate)
    {}

    public function view(): View
    {
        $query = Transaction_detail::query();
        $query->with('transaction_header', 'item', 'transaction_header.payment');

        if($this->startDate) {
            $query->whereHas('transaction_header', function ($subQuery) {
                $subQuery->where('created_at', '>=', $this->startDate);
            });
        }

        if($this->endDate) {
            $query->whereHas('transaction_header', function ($subQuery) {
                $subQuery->where('created_at', '<=', $this->endDate . ' 23:59:59');
            });
        }

        $transactions = $query->whereHas('item', function ($subQuery) {
                $subQuery->where('user_id', Auth::id());
            })->get();

        return view('excelExports.sellerHistory', [
            'transactions' => $transactions
        ]);
    }
}
