<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Tax;
use Illuminate\Support\Facades\DB;


class TaxesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('taxes')->insert([
            'id' => 1,
            'taxName' => 'Primerita',
            'amount' => 5598,
            'created_at' => '2023-12-10',
            'updated_at' => '2023-12-11',
        ]);

    }
}
