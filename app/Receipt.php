<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Receipt extends Model
{
    protected $fillable = [
        'user_id', 'creator_id', 'amount', 'payment_date_id', 'receipt_type'
    ];
}
