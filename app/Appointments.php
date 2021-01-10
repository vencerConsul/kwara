<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Appointments extends Model
{
    protected $fillable = [
        'schedule_date', 'schedule_time', 'schedule_message', 'schedule_place'
    ];

    public function SellerAppointments()
    {
        return $this->belongsTo('App\Seller');
    }
}
