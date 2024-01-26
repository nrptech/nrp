<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderProduct extends Model
{
    use HasFactory;
    protected $table = 'orders_has_products';

    protected $fillable = [
        'idPivot', 'Orders_idOrder', 'Products_idProduct',
    ];
}
