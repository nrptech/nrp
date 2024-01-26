<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\OrderProduct;

class OrderProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        OrderProduct::create([
            'idPivot' => 1,
            'Orders_idOrder' => 1,
            'Products_idProduct' => 1,
        ]);
    }
}
