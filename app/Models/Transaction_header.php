<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction_header extends Model
{
    protected $guarded = [];

    public function transaction_headers() {
        return $this->hasMany(Transaction_detail::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function payment() {
        return $this->belongsTo(Payment::class);
    }
}
