<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class ProductHasCategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('product_has_categories')->insert([
            'category_id' => 6,
            'product_id' => 1,
        ]);

        DB::table('product_has_categories')->insert([
            'category_id' => 7,
            'product_id' => 2,
        ]);

        DB::table('product_has_categories')->insert([
            'category_id' => 8,
            'product_id' => 3,
        ]);

        DB::table('product_has_categories')->insert([
            'category_id' => 3,
            'product_id' => 4,
        ]);

    }
}
