<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use App\Models\Wishlist;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'surname',
        'email',
        'password',
        'role_id',
        'language', 
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    // Set default language to English
    protected $attributes = [
        'language' => 'en',
    ];

    public function addresses()
    {
        return $this->hasMany(Address::class, 'user_id'  ,'id');
    }

    public function cart()
    {
        return $this->hasOne(Cart::class);
    }

    public function telephones()
    {
        return $this->hasMany(Telephone::class, "user_id"  , "id");
    }

    public function wishlist()
    {
        return $this->hasOne(Wishlist::class);
    }
    
    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function payMethods()
    {
        return $this->hasMany(PayMethod::class);
    }

    public function coupons()
    {
        return $this->hasMany(Coupon::class);
    }
}
