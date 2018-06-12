<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Period extends Model
{
    protected $fillable = [
        'partials', 'from', 'to', 'period_type_id', 'status', 'school_level_id'
    ];
}
