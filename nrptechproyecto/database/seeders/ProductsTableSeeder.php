<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        Product::create([
            'idProduct' => 1,
            'name' => 'ProductoEjemplo',
            'price' => 50.00,
            'description' => 'Descripción del producto',
            'discount' => 10,
            'Taxes_idTax' => 1,
            'color' => 'Rojo',
            'stock' => 100,
            'specs' => 'Especificaciones del producto',
            'features' => 'Características del producto',
        ]);
    }
}
