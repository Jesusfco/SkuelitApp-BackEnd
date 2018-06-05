<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment_Type extends Model
{
    protected $fillable = [
        'name', 'description', 'quantity', 'amount'
    ];
}
