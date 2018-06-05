<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Qualification extends Model
{
    protected $fillable = [
        'qualitfication', 'partial_id', 'student_id', 'subject_id', 'teacher_id'
    ];
}
