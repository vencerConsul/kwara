<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductAttributes extends Model
{
    protected $guarded = [];

    protected $dateFormat = 'Y-m-d H:i:s';

    protected $fillable = [
        'product_id', 'product_size', 'product_color'
    ];

    public function productAttr()
    {
        return $this->belongsToMany('App\Products');
    }
}
