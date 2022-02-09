<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{

    protected $guarded = [];

    // make relation with user
    public function client (){
        return $this->belongsTo(Client::class);
    }

    // make relation with product

    public function products(){
        return $this->belongsToMany(Product::class,'product_order')->withPivot('quantity');
    }


}
