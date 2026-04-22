<?php

namespace App\Policies;

use App\Models\Item;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ItemPolicy
{

    /**
     * Determine whether the user can view the model.
     */
    public function alreadyReviewed(?User $user, Item $item): bool
    {
        $reviews = $item?->reviews;
        foreach($reviews as $review) {
            if($review?->user->is($user)) {
                return true;
            }
        }

        return false;
    }

    public function hasNotBought(?User $user, Item $item): bool
    {
        $transaction_details = $item?->transaction_details;

        foreach($transaction_details as $transaction_detail) {
            if($transaction_detail->transaction_header?->user->is($user)) {
                return false;
            }
        }

        return true;
    }

    public function isOnCart(?User $user, Item $item): bool
    {
        $cart_items = $item?->cart_items;

        foreach($cart_items as $cart_item) {
            if($cart_item?->user->is($user)) {
                return true;
            }
        }

        return false;
    }
}
