<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
// use Illuminate\Foundation\Auth\User as Authenticatable;
use GoldSpecDigital\LaravelEloquentUUID\Foundation\Auth\User as Authenticatable;
use GoldSpecDigital\LaravelEloquentUUID\Database\Eloquent\Uuid;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable, Uuid;

    protected $guard = 'user';
    protected $keyType = 'string';
    public $incrementing = false;
    protected $guarded = [];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $dateFormat = 'Y-m-d H:i:s';

    protected $fillable = [
        'firstname', 'lastname', 'profile', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function shippingAddress()
    {
        return $this->hasOne('App\ShippingAddress');
    }

    public function cart()
    {
        return $this->hasMany('App\Cart');
    }

    public function orders()
    {
        return $this->hasMany('App\Order');
    }
}
