<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Telephone extends Model
{
    use HasFactory;
    protected $table = 'telephones';

    protected $fillable = [
        'tlfn', 'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
