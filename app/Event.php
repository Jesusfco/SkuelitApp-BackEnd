<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = [
        'group_id', 'name', 'description','img', 'from', 'to', 'type'
    ];
}
 