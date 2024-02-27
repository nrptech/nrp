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

        Product::create([
            'name' => 'Productoria',
            'price' => 129,
            'description' => "Es muy bueno!!",
            'tax_id' => 1,
            'coupon_id' => 1,
            'color' => 'ROJO',
            'stock' => 100,
            'specs' => 'Muy poderoso',
            'features' => 'Hace muchas cosas'
        ]);

        Product::create([
            'name' => 'Pruebax',
            'price' => 78,
            'description' => "Es aún mejor",
            'tax_id' => 1,
            'coupon_id' => 1,
            'color' => 'VERDE',
            'stock' => 100,
            'specs' => 'Más poderoso',
            'features' => 'Lo hace todo'
        ]);

        Product::create([
            'name' => 'Perro pajero',
            'price' => 1125,
            'description' => "Es muy Pajero!!",
            'tax_id' => 1,
            'coupon_id' => 1,
            'color' => 'Blanco',
            'stock' => 1,
            'specs' => 'Está todo el puto dia matandose a pajas',
            'features' => 'Tambien es capaz de mantener relaciones sexuales con otros perros'
        ]);

        Product::create([
            'name' => 'Don kamaron',
            'price' => 120,
            'description' => "No es tan bueno",
            'tax_id' => 1,
            'color' => 'VERDE',
            'stock' => 1450,
            'specs' => 'En don camarón tenemos el mejor lugar para comer en familia o en pareja, los mejores mariscos solo los encuentras aquí en el restaurante don camarón, también encuentras pollos y costillas asadas al estilo patzcuaro,y las micheladas al 2x1 todos los días, nuestro horario es de 12pm a 7 pm, estamos en el entronque por la entrada de autozone, don camarón el mejor lugar para comer en familia o en pareja.',
            'features' => 'Mariscos, Pollos, Costillas asadas al estilo patzcuaro, Micheladas'
        ]);

    }
}
