<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SchoolLevelModality extends Model
{
    protected $fillable = [
        'school_level_id', 'period_type_id'
    ];

}
