<?php

namespace App\Policies;

use App\Models\Payment;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class PaymentPolicy
{

    /**
     * Determine whether the user can edit the model.
     */
    public function canEdit(User $user, Payment $payment): bool
    {
        return $payment->user->is($user);
    }
}
