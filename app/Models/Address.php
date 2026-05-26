<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    protected $guarded = [];
    public $timestamps = false;

    public function transaction_header() {
        return $this->belongsTo(Transaction_header::class);
    }
}
