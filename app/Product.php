<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

    protected $dateFormat = 'Y-m-d H:i:s';

    // protected $casts = [
    //     'p_id' => 'string'
    // ];
    // protected $primaryKey = "p_id";

    protected $fillable = [
        'product_name', 'product_type', 'product_price', 'product_stock', 'product_discount', 'product_description', 'product_image'
    ];

    public function Seller()
    {
        return $this->belongsTo('App\Seller');
    }

    public function productAttributes()
    {
        return $this->hasMany('App\ProductAttributes');
    }
}
