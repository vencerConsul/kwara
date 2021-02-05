<?php

namespace App;

use GoldSpecDigital\LaravelEloquentUUID\Database\Eloquent\Model;
use GoldSpecDigital\LaravelEloquentUUID\Database\Eloquent\Uuid;

class Order extends Model
{
    use Uuid;

    protected $dateFormat = 'Y-m-d H:i:s';
    protected $keyType = 'string';
    public $incrementing = false;
    protected $guarded = [];

    protected $fillable = [
        'cart', 'status'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
