<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaymentType extends Model
{
    protected $fillable = [
        'name', 'description', 'quantity', 'amount', 'period_type_id', 'school_level_id'
    ];
}
