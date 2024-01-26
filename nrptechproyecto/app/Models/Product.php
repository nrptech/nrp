<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table = 'products';

    protected $fillable = [
        'idProduct', 'name', 'price', 'description', 'discount', 'Taxes_idTaxe', 'color', 'stock', 'specs', 'features',
    ];
}
