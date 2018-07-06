<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Conversation extends Model
{
    protected $fillable = [
        'users_id', 'updated_at'
    ];

    public $timestamps = false;


    public function messages()
    {
        return $this->hasMany('App\Message');
    }
}
