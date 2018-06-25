<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = [
        'message', 'from_id', 'to_id', 'checked', 'created_at'
    ];

    protected $timestamps = false;
}
