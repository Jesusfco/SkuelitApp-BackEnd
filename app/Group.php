<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    protected $fillable = [
        'students_id', 'subjects_id', 'grade','group', 'level'
    ];
}
 