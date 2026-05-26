<?php

namespace App\Http\Controllers;

use App\Models\Approval;
use App\Services\ApprovalService;
use App\Services\TransactionService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class DashboardController extends Controller
{

    public function __construct(protected TransactionService $transactionService)
    {}

    public function sellerDashboard() {
        if (Gate::allows('isSeller')) {
            return view('Dashboard', 
                [
                    'emptyStockData' => $this->transactionService->getEmptyStockData(),
                    'metricData' =>  $this->transactionService->getSellerTotalItemData(),
                    'transactions' => $this->transactionService->getSellerSalesData()
                ]
            );
        } else {
            abort(403);
        }
    }

}
