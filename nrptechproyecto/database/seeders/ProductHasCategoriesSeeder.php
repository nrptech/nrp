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
            'category_id' => 2,
            'product_id' => 1,
        ]);

        DB::table('product_has_categories')->insert([
            'category_id' => 1,
            'product_id' => 2,
        ]);

        DB::table('product_has_categories')->insert([
            'category_id' => 4,
            'product_id' => 3,
        ]);

        DB::table('product_has_categories')->insert([
            'category_id' => 7,
            'product_id' => 4,
        ]);

        DB::table('product_has_categories')->insert([
            'category_id' => 7,
            'product_id' => 4,
        ]);

        DB::table('product_has_categories')->insert([
            'category_id' => 6,
            'product_id' => 6,
        ]);

        DB::table('product_has_categories')->insert([
            'category_id' => 3,
            'product_id' => 7,
        ]);

        DB::table('product_has_categories')->insert([
            'category_id' => 10,
            'product_id' => 8,
        ]);

        DB::table('product_has_categories')->insert([
            'category_id' => 8,
            'product_id' => 9,
        ]);

        DB::table('product_has_categories')->insert([
            'category_id' => 5,
            'product_id' => 10,
        ]);

        DB::table('product_has_categories')->insert([
            'category_id' => 5,
            'product_id' => 11,
        ]);

        DB::table('product_has_categories')->insert([
            'category_id' => 9,
            'product_id' => 12,
        ]);

        DB::table('product_has_categories')->insert([
            'category_id' => 8,
            'product_id' => 13,
        ]);

        DB::table('product_has_categories')->insert([
            'category_id' => 10,
            'product_id' => 14,
        ]);

        DB::table('product_has_categories')->insert([
            'category_id' => 7,
            'product_id' => 15,
        ]);

        DB::table('product_has_categories')->insert([
            'category_id' => 11,
            'product_id' => 16,
        ]);

        DB::table('product_has_categories')->insert([
            'category_id' => 7,
            'product_id' => 17,
        ]);

        DB::table('product_has_categories')->insert([
            'category_id' => 7,
            'product_id' => 18,
        ]);

        DB::table('product_has_categories')->insert([
            'category_id' => 4,
            'product_id' => 19,
        ]);

        DB::table('product_has_categories')->insert([
            'category_id' => 9,
            'product_id' => 20,
        ]);

        DB::table('product_has_categories')->insert([
            'category_id' => 1,
            'product_id' => 21,
        ]);

        DB::table('product_has_categories')->insert([
            'category_id' => 2,
            'product_id' => 22,
        ]);
    }
}
