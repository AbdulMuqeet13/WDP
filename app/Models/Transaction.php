<?php

namespace App\Models;

use Bavix\Wallet\Models\Transaction as BaseTransaction;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Transaction extends BaseTransaction
{
    protected $appends = ['amount_float'];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
    }

    /**
     * Accessor to always return amount as float.
     */
    protected function amount(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $value / 100 ,
        );
    }

    /**
     * Optionally, add a separate accessor if you also want `amount_float`
     */
    public function getAmountFloatAttribute(): string
    {
        return $this->amount; // same as getAmountAttribute
    }
}
