<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaymentDates extends Model
{
    protected $fillable = [
        'date', 'payment_type_id', 'period_id'
    ];
}
