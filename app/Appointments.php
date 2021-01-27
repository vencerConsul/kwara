<?php

namespace App;

use GoldSpecDigital\LaravelEloquentUUID\Database\Eloquent\Uuid;
use GoldSpecDigital\LaravelEloquentUUID\Database\Eloquent\Model;

class Appointments extends Model
{
    use Uuid;
    protected $keyType = 'string';
    public $incrementing = false;
    protected $guarded = [];
    
    protected $fillable = [
        'schedule_date', 'schedule_time', 'schedule_message', 'schedule_place'
    ];

    public function SellerAppointments()
    {
        return $this->belongsTo('App\Seller');
    }
}
