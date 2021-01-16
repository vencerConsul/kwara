<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $dateFormat = 'Y-m-d H:i:s';

    protected $fillable = [
        'product_name', 'product_type', 'product_price', 'product_stock', 'product_discount', 'product_description', 'product_image', 'product_session_id', 'user_id', 'product_id', 'product_quantity', 'product_size', 'product_color'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
