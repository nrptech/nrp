<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;
use Illuminate\Support\Facades\DB;


class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('products')->insert([
            'id' => 1,
            'name' => 'Portátil to tocho',
            'price' => 375000,
            'description' => 'Está to fuerte',
            'discount' => 6,
            'idTax' => 1,
            'color' => 'Azul',
            'stock' => 100,
            'specs' => 'Equipo gaming RGB caro caro',
            'features' => 'Cosas guapas',
        ]);
    }
}
