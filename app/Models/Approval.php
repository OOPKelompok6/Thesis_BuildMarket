<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Approval extends Model
{
    protected $guarded = ['blob_link'];

    protected function casts(): array
    {
        return [
            'npwp_number' => 'hashed'
        ];
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

}
