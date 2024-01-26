<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryProduct extends Model
{
    use HasFactory;
    protected $table = 'categories_has_products';

    protected $fillable = [
        'idPivot', 'Categories_idCategorie', 'Products_idProduct',
    ];
}
