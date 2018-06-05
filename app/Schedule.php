<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    protected $fillable = [
        'group_id', 'subject_id', 'check_in', 'check_out', 'day', 'teacher_id', 'creator_id'
    ];
}
