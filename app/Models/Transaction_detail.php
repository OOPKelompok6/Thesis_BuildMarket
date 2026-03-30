<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction_detail extends Model
{
    protected $guarded = [];
    public $timestamps = false;

    public function transaction_header() {
        return $this->belongsTo(Transaction_header::class);
    }

    public function item() {
        return $this->belongsTo(Item::class);
    }
}
