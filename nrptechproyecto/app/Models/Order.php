<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $table = 'orders';

    protected $fillable = [
        'user_id', 'state',
    ];

    public function invoice()
    {
        return $this->hasOne(Invoice::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class);
    }
}
