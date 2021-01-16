<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

    protected $dateFormat = 'Y-m-d H:i:s';

    protected $fillable = [
        'id', 'product_name', 'product_type', 'product_price', 'product_stock', 'product_discount', 'product_description', 'product_image'
    ];

    public function SellerProduct()
    {
        return $this->belongsToMany('App\Seller');
    }

    public function productAttributes()
    {
        return $this->hasMany('App\ProductAttributes');
    }

}
