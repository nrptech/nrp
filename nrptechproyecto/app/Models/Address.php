<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;
    protected $table = 'addresses';

    protected $fillable = [
        'user_id', 'name', 'province', 'city', 'street', 'number', 'pc', 'country', 'deleted',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
