<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tax extends Model
{
    use HasFactory;
    protected $table = 'taxes';

    protected $fillable = [
        'taxName', 'amount',
    ];

    public function products()
    {
        return $this->hasMany(Product::class, 'tax_id'  , 'id');
    }
}
