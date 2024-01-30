<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;
    protected $table = 'invoices';

    protected $fillable = [
        'idInvoices', 'idOrder', 'total', 'date',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
