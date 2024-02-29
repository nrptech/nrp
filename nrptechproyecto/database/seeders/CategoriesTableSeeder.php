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
        Category::create([ //1
            'name' => 'PCs',
        ]);

        Category::create([ //2
            'name' => 'Portátiles',
        ]);

        Category::create([ //3
            'name' => 'CPU',
        ]);

        Category::create([ //4
            'name' => 'GPU',
        ]);

        Category::create([ //5
            'name' => 'RAM',
        ]);
        
        Category::create([ //6
            'name' => 'Monitor',
        ]);

        Category::create([ //7
            'name' => 'Periférico',
        ]);

        Category::create([ //8
            'name' => 'Disipadores',
        ]);

        Category::create([ //9
            'name' => 'Almacenamiento',
        ]);

        Category::create([ //10
            'name' => 'Placa Base',
        ]);

        Category::create([ //11
            'name' => 'Alimentación',
        ]);
    }
}
