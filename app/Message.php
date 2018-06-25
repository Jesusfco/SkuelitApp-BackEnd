<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = [
        'conversation_id', 'message', 'from_id', 'checked', 'created_at'
    ];

    public $timestamps = false;
}
