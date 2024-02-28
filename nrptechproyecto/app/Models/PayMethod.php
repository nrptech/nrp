<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PayMethod extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'name','card_number', 'card_holder', 'cvv', 'deleted'];

    /**
     * Define la relación inversa con el Usuario.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
