<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;
    protected $table = 'users';

    protected $fillable = [
        'idUser', 'Carts_idCart', 'name', 'surname', 'email', 'password', 'Userscol',
    ];
}
