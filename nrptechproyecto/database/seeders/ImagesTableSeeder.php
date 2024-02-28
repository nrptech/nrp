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
            'url' => "images/portatil1.webp",
        ]);

        Image::create([
            'product_id' => 1,
            'url' => "images/portatil2.webp",
        ]);

        Image::create([
            'product_id' => 1,
            'url' => "images/portatil3.webp",
        ]);

        Image::create([
            'product_id' => 1,
            'url' => "images/portatil4.webp",
        ]);

        Image::create([
            'product_id' => 2,
            'url' => "images/pc1.webp",
        ]);

        Image::create([
            'product_id' => 2,
            'url' => "images/pc2.webp",
        ]);

        Image::create([
            'product_id' => 2,
            'url' => "images/pc3.webp",
        ]);

        Image::create([
            'product_id' => 2,
            'url' => "images/pc4.webp",
        ]);
        Image::create([
            'product_id' => 3,
            'url' => "images/rtx1.webp",
        ]);

        Image::create([
            'product_id' => 3,
            'url' => "images/rtx2.webp",
        ]);

        Image::create([
            'product_id' => 3,
            'url' => "images/rtx3.webp",
        ]);

        Image::create([
            'product_id' => 3,
            'url' => "images/rtx4.webp",
        ]);

        Image::create([
            'product_id' => 4,
            'url' => "images/kb1.webp",
        ]);

        Image::create([
            'product_id' => 4,
            'url' => "images/kb2.webp",
        ]);

        Image::create([
            'product_id' => 4,
            'url' => "images/kb3.webp",
        ]);

        Image::create([
            'product_id' => 4,
            'url' => "images/kb4.webp",
        ]);

    }
}
