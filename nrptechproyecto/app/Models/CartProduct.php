<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartProduct extends Model
{
    use HasFactory;
    protected $table = 'carts_has_products';

    protected $fillable = [
        // Define las columnas según la tabla carts_has_products
    ];
}
