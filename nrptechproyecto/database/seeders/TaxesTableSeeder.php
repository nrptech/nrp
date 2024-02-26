<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Tax;
use Illuminate\Support\Facades\DB;


class TaxesTableSeeder extends Seeder
{
    
    public function run(): void
    {
        
        Tax::create([
            'taxName' => 'IVA',
            'amount' => 21,
        ]);

        Tax::create([
            'taxName' => 'Prueba',
            'amount' => 5,
        ]);

    }
}
