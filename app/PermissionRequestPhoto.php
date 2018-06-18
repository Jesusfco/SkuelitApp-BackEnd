<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PermissionRequestPhoto extends Model
{
    protected $fillable = [
        'img', 'description', 'permission_request_id'
    ];

    protected $timestamp = false;
}
