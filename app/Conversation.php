<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Conversation extends Model
{
    protected $fillable = [
        'users_id'
    ];

    public $timestamps = false;


    public function messages()
    {
        return $this->hasMany('App\Message');
    }
}
