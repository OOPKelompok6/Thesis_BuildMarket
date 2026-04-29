<?php

namespace App\Services;

use App\Models\Payment;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class PaymentService
{

    public function getPayments($user) {
        return $user->payments;
    }

    public function createPayment($payment) {
        $payment['user_id'] = Auth::user()->id;
        Payment::create($payment);
    }

    public function deletePayment($payment) {
        $payment->delete();
    }

    public function editPayment($payment, $paymentNew) {
        $payment->vendor = $paymentNew['vendor'];
        $payment->billingAddress = $paymentNew['billingAddress'];
        $payment->expiration_Date = $paymentNew['expiration_Date'];
        $payment->cardNumber = $paymentNew['cardNumber'];

        $payment->save();
    }
}
