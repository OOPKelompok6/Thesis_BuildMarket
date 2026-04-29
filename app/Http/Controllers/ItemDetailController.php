<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Services\ItemService;
use App\Services\ReviewService;

class ItemDetailController extends Controller
{

    public function __construct(protected ItemService $itemService, protected ReviewService $reviewService)
    {}

    public function itemDetail(Item $item) {
        $reviews = $this->reviewService->getReviews($item);
        $similarItems = $this->itemService->getSimilarItems($item);

        return view('NewItemDetail', [
            'item' => $item,
            'reviews' => $reviews,
            'similarItems' => $similarItems
        ]);
        // return view('itemDetail', ['item' => $item, 'reviews' =>$this->reviewService->getReviews($item)]);
    }

    public function postReview(Item $item) {
        $this->reviewService->createReview($item, request()->input('review'));
        return redirect('/item/' . $item->id);
    }
}
