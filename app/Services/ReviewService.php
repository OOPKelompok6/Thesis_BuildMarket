<?php

namespace App\Services;


use App\Models\Item;
use App\Models\Review;
use Illuminate\Support\Facades\Auth;

class ReviewService
{

    public function getReviews(Item $item)
    {
        return $item->reviews()->with('user')->paginate(5);
    }

    public function createReview(Item $item, $review)
    {
        Review::create([
            'item_id' => $item->id,
            'user_id' => Auth::user()->id,
            'review' => $review
        ]);
    }
}
