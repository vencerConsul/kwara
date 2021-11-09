<?php

namespace App;

use GoldSpecDigital\LaravelEloquentUUID\Database\Eloquent\Model;
use GoldSpecDigital\LaravelEloquentUUID\Database\Eloquent\Uuid;

class Product extends Model
{
    use Uuid;

    protected $dateFormat = 'Y-m-d H:i:s';
    protected $keyType = 'string';
    public $incrementing = false;
    protected $guarded = [];

    protected $fillable = [
        'product_name', 'product_type', 'product_price', 'product_stock', 'product_discount', 'product_description', 'product_image', 'product_image_url', 'product_size', 'product_color'
    ];

    public function Seller()
    {
        return $this->belongsTo('App\Seller');
    }
}
