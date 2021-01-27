<?php

namespace App;

use GoldSpecDigital\LaravelEloquentUUID\Database\Eloquent\Model;
use GoldSpecDigital\LaravelEloquentUUID\Database\Eloquent\Uuid;

class Cart extends Model
{
    use Uuid;

    protected $dateFormat = 'Y-m-d H:i:s';
    protected $keyType = 'string';
    public $incrementing = false;
    protected $guarded = [];

    protected $fillable = [
        'product_name', 'product_type', 'product_price', 'product_stock', 'product_discount', 'product_description', 'product_image', 'product_cookie_id', 'user_id', 'product_id', 'product_quantity', 'product_size', 'product_color', 'cartExpiration'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
