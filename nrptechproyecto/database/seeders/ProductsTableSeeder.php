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
            'name' => 'Portátil UltraSlim',
            'price' => 1350,
            'description' => "Diseño ultradelgado y potencia excepcional con su procesador de última generación.",
            'tax_id' => 1,
            'coupon_id' => 1,
            'color' => 'Plata Estelar',
            'stock' => 80,
            'specs' => 'Pantalla Full HD, Teclado retroiluminado',
            'features' => 'Movilidad extrema y rendimiento superior'
        ]);
        
        Product::create([
            'name' => 'PC Gamer Xtreme',
            'price' => 2500,
            'description' => "Diseñada para gamers, con tarjeta gráfica potente y gran capacidad de almacenamiento.",
            'tax_id' => 1,
            'coupon_id' => 1,
            'color' => 'Negro/Rojo',
            'stock' => 50,
            'specs' => 'Procesador de alta frecuencia, Tarjeta gráfica dedicada',
            'features' => 'Experiencia de juego inmersiva'
        ]);
        

        Product::create([
            'name' => 'Tarjeta Gráfica GeForce RTX 3080',
            'price' => 1200,
            'description' => "Potencia gráfica incomparable para juegos y aplicaciones de edición de video.",
            'tax_id' => 1,
            'coupon_id' => 1,
            'color' => 'Plateado/Negro',
            'stock' => 30,
            'specs' => 'Memoria GDDR6, Ray Tracing en tiempo real',
            'features' => 'Rendimiento gráfico de última generación'
        ]);        

        Product::create([
            'name' => 'Teclado Mecánico RGB',
            'price' => 150,
            'description' => "Switches mecánicos para una experiencia de escritura rápida y precisa.",
            'tax_id' => 1,
            'coupon_id' => 1,
            'color' => 'Negro',
            'stock' => 120,
            'specs' => 'Switches mecánicos, Retroiluminación RGB',
            'features' => 'Comodidad y estilo para tus sesiones de juego o trabajo'
        ]);
        

    }
}
