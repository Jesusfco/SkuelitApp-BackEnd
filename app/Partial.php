<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Partial extends Model
{
    protected $fillable = [
        'period_id', 'partial', 'from','to'
    ];
}
