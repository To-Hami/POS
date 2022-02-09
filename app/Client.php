<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $guarded = [];
    protected $casts=[
        'phone' => 'array'
    ];


    // relationship with model order
    public function orders(){
        return $this->hasMany(Order::class);
    }
}
