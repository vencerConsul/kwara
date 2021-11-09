<?php

namespace App;

use GoldSpecDigital\LaravelEloquentUUID\Database\Eloquent\Model;
use GoldSpecDigital\LaravelEloquentUUID\Database\Eloquent\Uuid;

class OrderProduct extends Model
{
    use Uuid;

    protected $dateFormat = 'Y-m-d H:i:s';
    protected $keyType = 'string';
    public $incrementing = false;
    protected $guarded = [];

    protected $fillable = [
        'seller_id', 'order_number', 'product_id', 'product_name', 'product_price', 'product_image', 'product_image_url', 'product_quantity',
        'total_price', 'status'
    ];


    public function order()
    {
        return $this->belongsTo('App\Order');
    }
}
