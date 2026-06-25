<?php

namespace App\Http\Controllers;

use App\Exports\SellerHistoryExport;
use App\Models\Approval;
use App\Services\ApprovalService;
use App\Services\TransactionService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Maatwebsite\Excel\Facades\Excel;

class DashboardController extends Controller
{

    public function __construct(protected TransactionService $transactionService)
    {}

    public function sellerDashboard() {
        $startDate = request('startDate');
        $endDate = request('endDate');

        if (Gate::allows('isSeller')) {

            return view('Dashboard', 
                [
                    'emptyStockData' => $this->transactionService->getEmptyStockData(),
                    'metricData' =>  $this->transactionService->getSellerTotalItemData(),
                    'transactions' => $this->transactionService->getSellerSalesData($startDate, $endDate)
                ]
            );
        } else {
            abort(403);
        }
    }

    public function exportExcel() 
    {
        $startDate = request('startDate');
        $endDate = request('endDate');

        return Excel::download(new SellerHistoryExport($startDate, $endDate), 'Sell_History.xlsx');
    }

}
