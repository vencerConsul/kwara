<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ShippingAddress extends Model
{
    protected $fillable = [
        'firstname', 'lastname', 'address', 'country', 'postal_code', 'phone_number',
    ];

    public function ShippingAddress()
    {
        return $this->belongsTo('App\User');
    }
}
