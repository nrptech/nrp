<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Telephone;

class TelephonesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Telephone::create([
            'idTelephone' => 1,
            'tlfn' => '123456789',
            'idUser' => 1,
        ]);

    }
}
