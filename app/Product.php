<?php

namespace App;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laratrust\Traits\LaratrustUserTrait;

class Product extends Model
{
    use Translatable;
    use LaratrustUserTrait;
    use Notifiable;

    protected $guarded = ['id'];

    public $translatedAttributes = ['name','description'];
    protected $appends = ['image_path', 'profit_percent'];

    // protected $hidden = ['image_path','profit_percent','name','description'];


    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function orders()
    {
        return $this->belongsToMany(Order::class, 'product_order');
    }


    public function getImagePathAttribute()
    {
        return asset('uploads/products_images/' . $this->image);

    }


    public function getProfitProductAttribute()
    {
        $profit = $this->stock - $this->now_stock;
        $profit_product = $profit * ($this->sale_price - $this->purchase_price);
        if ($this->now_stock == 0) {
            $this->now_stock = $this->stock;
        }

        if ($this->stock == $this->now_stock) {
            return 0;
        } else {
            return number_format($profit_product);
        }

    }
}
