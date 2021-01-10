<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ShippingAddress extends Model
{
    protected $fillable = [
        'user_id', 'firstname', 'lastname', 'address', 'country', 'postal_code', 'phone_number',
    ];

    public function userAddresses()
    {
        return $this->belongsTo('App\User');
    }
}
