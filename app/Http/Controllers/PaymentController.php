<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Services\PaymentService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
class PaymentController extends Controller
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

    public function newPayment() {
        if (Gate::allows('isUser') || Gate::allows('isSeller')) {
            return view('Payments.PaymentNew', ['user' => Auth::user(), 
                        'vendors' => ['Visa', 'Discover', 'MasterCard', 'American Express', 'JCB']]);
        } else {
            abort(403);
        }
    }

    public function createPayment() {
        $payment = request()->validate([
            'vendor' => ['required'],
            'expiration_Date' => ['required', 'date', 'after_or_equal:today'],
            'cardNumber' => ['required', 'min:16'],
            'billingAddress' => ['required']
        ], [
            'vendor.required' => 'Card vendor is required',

            'expiration_Date.required' => 'Expiration date is required',
            'expiration_Date.date' => 'Expiration date must be a date format',
            'expiration_Date.after_or_equal' => 'Expiration date must be more or equal to today',

            'cardNumber.required' => 'Card Number is required',
            'cardNumber.min' => 'Card Number length must be equal or more than 16',

            'billingAddress.required' => 'Billing address is required' 
        ]);

        $this->paymentService->createPayment($payment);

        return redirect('/payments');
    }

    public function deletePayment(Payment $payment) {
        $this->paymentService->deletePayment($payment);
        return redirect('/payments');
    }

    public function editPayment(Payment $payment) {
        if ((Gate::allows('isUser') || Gate::allows('isSeller')) && (Gate::allows('canEdit', $payment))){
            return view('Payments.PaymentUpdate', ['user' => Auth::user(), 
                        'vendors' => ['Visa', 'Discover', 'MasterCard', 'American Express', 'JCB'],
                        'payment' => $payment]);
        } else {
            abort(403);
        }
    }

    public function updatePayment(Payment $payment) {
        $paymentNew = request()->validate([
            'vendor' => ['required'],
            'expiration_Date' => ['required', 'date', 'after_or_equal:today'],
            'cardNumber' => ['required', 'min:16'],
            'billingAddress' => ['required']
        ], [
            'vendor.required' => 'Card vendor is required',

            'expiration_Date.required' => 'Expiration date is required',
            'expiration_Date.date' => 'Expiration date must be a date format',
            'expiration_Date.after_or_equal' => 'Expiration date must be more or equal to today',

            'cardNumber.required' => 'Card Number is required',
            'cardNumber.min' => 'Card Number length must be equal or more than 16',

            'billingAddress.required' => 'Billing address is required' 
        ]);

        $this->paymentService->editPayment($payment, $paymentNew);

        return redirect('/payments');
    }

}
