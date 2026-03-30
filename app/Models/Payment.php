<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected function casts(): array
    {
        return [
            'cardNumber' => 'hashed'
        ];
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function transaction_headers() {
        return $this->hasMany(Transaction_header::class);
    }
}
