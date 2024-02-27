<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Image;

class ImagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Image::create([
            'product_id' => 1,
            'url' => "images/nrp.webp",
        ]);

        Image::create([
            'product_id' => 2,
            'url' => "images/nrp.webp",
        ]);

        Image::create([
            'product_id' => 1,
            'url' => "images/xokas.jpg",
        ]);

        Image::create([
            'product_id' => 3,
            'url' => "images/prros.jpg",
        ]);

        Image::create([
            'product_id' => 3,
            'url' => "images/patrocinador.png",
        ]);

        Image::create([
            'product_id' => 3,
            'url' => "images/xokas.jpg",
        ]);

        Image::create([
            'product_id' => 4,
            'url' => "images/patrocinador.png",
        ]);

    }
}
