<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class ItemController extends Controller
{

    public function __construct(protected PaymentService $paymentService)
    {}

    public function payments() {
        if (Gate::allows('isUser') || Gate::allows('isSeller')) {
            return view('Payments.Payment', 
                ['payments' => $this->paymentService->getPayments(Auth::user()),
                 'user' => Auth::user()
                ]);
        } else {
            abort(403);
        }
    }

}
