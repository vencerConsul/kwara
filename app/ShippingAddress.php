<?php

namespace App;

use GoldSpecDigital\LaravelEloquentUUID\Database\Eloquent\Model;
use GoldSpecDigital\LaravelEloquentUUID\Database\Eloquent\Uuid;

class ShippingAddress extends Model
{
    use Uuid;

    protected $keyType = 'string';
    public $incrementing = false;
    protected $guarded = [];

    protected $fillable = [
        'firstname', 'lastname', 'address', 'country', 'postal_code', 'phone_number',
    ];

    public function ShippingAddress()
    {
        return $this->belongsTo('App\User');
    }
}
