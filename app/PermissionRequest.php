<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PermissionRequest extends Model
{
    protected $fillable = [
        'user_id', 'subject', 'description', 'from' , 'to', 'confirmed'
    ];
}
