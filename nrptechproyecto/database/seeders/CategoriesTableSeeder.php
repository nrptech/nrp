<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::create([
            'name' => 'CPU',
        ]);

        Category::create([
            'name' => 'RAM',
        ]);

        Category::create([
            'name' => 'Periférico',
        ]);

        Category::create([
            'name' => 'Monitor',
        ]);

        Category::create([
            'name' => 'Disipadores',
        ]);
    }
}
