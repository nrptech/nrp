<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\PayMethod;

class PayMethodsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PayMethod::create([
            'user_id' => 1,
            'name' => "Tarjeta negra",
            'card_holder' => "Manuel Nogales",
            'card_number' =>  1234567891234567,
            'cvv' => 123,
        ]);

        PayMethod::create([
            'user_id' => 2,
            'name' => "Tarjeta negra",
            'card_holder' => "Manuel Nogales",
            'card_number' =>  1234567891234567,
            'cvv' => 123,
        ]);
    }
}
