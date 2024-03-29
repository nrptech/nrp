<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;
    protected $table = 'invoices';

    protected $fillable = [
        'order_id', 'total',"address_id", "payMethod_id", 'date',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
