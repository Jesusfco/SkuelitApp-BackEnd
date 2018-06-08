<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PeriodsTypes extends Model
{
    protected $fillable = [
        'name', 'months'
    ];
}
