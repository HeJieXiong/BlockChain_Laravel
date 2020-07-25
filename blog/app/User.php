<?php

namespace App;

use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable;
    const ROLE_ADMIN = 1;
    const ROLE_USER = 2;

    protected $fillable = [
        'username', 
        'password',
        'full_name',
        'phone_number',
        'address',
        'role'
    ];

    protected $hidden= [
        "password"
    ];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    public function wallets()
    {
        return $this->hasMany(Wallet::class, 'user_id');
    }
}