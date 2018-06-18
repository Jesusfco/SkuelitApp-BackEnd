<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = [
        'message', 'from', 'to', 'read', 'created_at'
    ];

    protected $timestamp = false;
}
