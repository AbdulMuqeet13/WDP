<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserTransaction extends Model
{
    protected $fillable = [
        'user_id',
        'type',
        'amount',
        'status',
        'description',
        'screenshot',
        'wallet_address',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
